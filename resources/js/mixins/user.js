import axios from 'axios';

class User{
    isLoggedIn(cb){
        axios.get('/user').then(response=>{
            cb(true);
        }).catch(err=>{            
            cb(false);
        });
    }
}


export default User = new User();
