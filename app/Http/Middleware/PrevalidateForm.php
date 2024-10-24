<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Support\Facades\DB;

class PrevalidateForm{
    protected $validationFactory;

    public function __construct(ValidationFactory $validationFactory){
        $this->validationFactory = $validationFactory;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){
        
        if($request->has('prevalidate')){   
            DB::beginTransaction();
            try {
                $action = $request->route()->getAction();
                $controller = $action['controller'];
                list($class, $method) = explode('@', $controller);
        
                $reflectionMethod = new \ReflectionMethod($class, $method);
                $parameters = $reflectionMethod->getParameters();
                $customRequestClass = null;
                foreach ($parameters as $parameter) {
                    $class = $parameter->getClass();
                    if ($class && is_subclass_of($class->name, \Illuminate\Foundation\Http\FormRequest::class)) {
                        // Check that the class is not Request
                        if ($class->name !== \Illuminate\Http\Request::class) {
                            $customRequestClass = $class->name;
                            break;
                        }
                    }
                }
        
                if ($customRequestClass) {
                    $customRequest = app($customRequestClass);
                    $customRequest->setContainer(app());
                    $customRequest->setRedirector(app('redirect'));
                    $validator = app('validator')->make($request->all(), $customRequest->rules($request), $customRequest->messages());
                    if ($validator->fails()) {
                        return response()->json([
                            'success'   => false,
                            'message'   => 'The given data was invalid.',
                            'errors'      => $validator->errors()
                        ], 422);
                    }else{
                        return response()->json([
                            'success' => true,
                        ]);
                    }
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return $next($request);
            }
        }
        DB::rollBack();
        return $next($request);
    }
}
