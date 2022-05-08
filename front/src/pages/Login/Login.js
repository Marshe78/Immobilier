import React, { Fragment, useEffect, useState } from "react";
import { useNavigate  } from "react-router-dom";
import axios from "utils/axios";
import * as qs from 'qs'

const Login = ({ setToken, getToken }) => {
  const navigate = useNavigate();

  useEffect(() => {
    if (getToken() !== null)
      navigate('/');
  }, []);
  
  const [formData, setFormData] = useState({
    Email: "",
    Password: "",
  });

  const { Email, Password } = formData;

  const onChange = (e) =>
    setFormData({ ...formData, [e.target.name]: e.target.value });

  const onSubmit = async (e) => {
    e.preventDefault();
    const newUser = {
      Email,
      Password,
    };
    
    try {
      const body = qs.stringify(newUser);
      const res = await axios.post("/utilisateur/login", body);
      setToken(res.data);
      navigate('/');
    } catch (err) {
      console.error(err.response.data);
    };
    
  }
    const style = "form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none";

  return (
        <Fragment>
            <div className="block mt-6 m-auto p-6 rounded-lg shadow-lg bg-white max-w-sm">
        
            <h1 className='large text-primary'>Me connecter</h1>
            <form className='form' onSubmit={(e) => onSubmit(e)}>
                    <div className='form-group mb-6'>
                        <label htmlFor="InputEmailLogin" className="form-label inline-block mb-2 text-gray-700">Mon adresse mail</label>
                        <input
                            id="InputEmailLogin"
                            className={style}
                            onChange={onChange}
                            type='email'
                            placeholder='Email Address'
                            name='Email'
                            value={Email}
                        />
                    </div>
                    <div className='form-group mb-6'>
                        <label htmlFor="InputPasswordLogin" className="form-label inline-block mb-2 text-gray-700">Mon mot de passe</label>
                        <input
                            id="InputPasswordLogin"
                            className={style}
                            onChange={onChange}
                            type='Password'
                            placeholder='Password'
                            name='Password'
                            minLength='6'
                            value={Password}
                        />
                    </div>
                    
                <button
                    onChange={onChange}
                    className="
                    mt-3
                    px-6
                    py-2.5
                    bg-blue-600
                    text-white
                    font-medium
                    text-xs
                    leading-tight
                    uppercase
                    rounded
                    shadow-md
                    hover:bg-blue-700 hover:shadow-lg
                    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-blue-800 active:shadow-lg
                    transition
                    duration-150
                    ease-in-out"
                      type='submit' >Me connecter</button>
            </form>
        </div>
    </Fragment>
  );
};

export default Login;