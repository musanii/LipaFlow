import { useState,useContext } from "react";
import { AuthContext } from "../context/AuthContext";

export default function login(){
    const {login} = useContext(AuthContext);

    const[email,setEmail] = useState("");
    const[password,setPassword] = useState("");

    const submit = async(e)=>{
        e.preventDefault();
        await login(email,password);
    }

    return (
        <div>
            <h2>LipaFlow POS Login</h2>

            <form  onSubmit={submit}>

                <input placeholder="email"
                value={email}
                onChange={e=>setEmail(e.target.value)}
                 />

                 <input type="password"
                 placeholder="password"
                 value={password}
                 onChange={e=>setPassword(e.target.value)}
                  />

                  <button>Login</button>

            </form>
        </div>
    )
}