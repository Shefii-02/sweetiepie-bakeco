<html>
    <head>
        <title>Email Campaign</title>
    </head>
    <body>
        
        <h1>Email Campaign</h1>
        
        @if($_POST)
        
        
        <h3><font color="green">Successfully sent emails to {{count($send_users)}} users </font> @if(count($send_users)>0) &#128077; @else &#128078; @endif </h3>
        
        <ul>
            @foreach($send_users as $send_user)
            
            <li>{{$send_user['name']}} &lt;{{$send_user['email']}}&gt;</li>
            @endforeach
        </ul>
        
        
        <hr/>
        
        @endif
        
        <form action="" method="post">
            @csrf
            <h3>Please choose recipients</h3>
            
            <p>
                <table cellpadding="5" border="2" >
                    @foreach($users as $user)
                
                    <tr>
                        <td><input type="checkbox" name="users[]" value="{{$user['email'].'|'.$user['name']}}" /></td>
                        <td>{{$user['email']}}</td>
                        <td>{{$user['name']}}</td>
                    </tr>
                
                
                    @endforeach
                    
                </table>
                
            </p>
            
            <h3>Enter the message</h3>
            
            <p>
                <label>Use "<font color="green">[NAME]</font>" to inser the user's fullname into the message.</label><br/>
                <textarea name="message" rows="10" cols="100" placeholder="Enter the message"></textarea>
            </p>
            
            <p>
                <input type="reset" value="Reset" />
                <input type="submit" value="Submit" />
            </p>
            
        </form>
        
    </body>
</html>