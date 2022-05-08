import React, { Fragment, useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import axios from "utils/axios";
import * as qs from 'qs'

const Register = ({getToken, ROLE}) => {
  const navigate = useNavigate();
  useEffect(() => {
    if (getToken() === null || ROLE !== 'ROLE_ADMIN')
      navigate('/');
  }, []);

  const [formData, setFormData] = useState({
    Nom: "",
    Prenom: "",
    Email: "",
    Password: "",
    Role: "",
  });

  const { Nom, Prenom,  Email, Password, passwordBis, Role } = formData;

  const onChange = (e) =>
    setFormData({ ...formData, [e.target.name]: e.target.value });

  const onSubmit = async (e) => {
    e.preventDefault();
    if (Password !== passwordBis) {
      console.log("Passwords do not match");
    } else {
     console.log(formData);
      const newUser = {
        Nom,
        Prenom,
        Email,
        Password,
        Role
      };
      try {
        const token = getToken();
        console.log(token);
        const settings = {
          headers: { 
            'Token': getToken(), 
          },
        };
        const body = qs.stringify(newUser);
        const res = await axios.post("/utilisateur/sign", body, settings);
        console.log(res.data);
      } catch (err) {
        console.error(err.response.data);
      }
    }
    };
    

  const style = "form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none";

  return (
        <Fragment>
            <div className="block mt-6 m-auto p-6 rounded-lg shadow-lg bg-white max-w-sm">
        
            <h1 className='large text-primary'>Inscrire un utilisateur</h1>
            <form className='form' onSubmit={(e) => onSubmit(e)}>
                    <div className='form-group mb-6'>
                        <label htmlFor="InputNom" className="form-label inline-block mb-2 text-gray-700">Votre nom</label>
                        <input
                            id="InputNom"
                            className={style}
                            onChange={onChange}
                            type='text'
                            placeholder='Nom'
                            name='Nom'
                            value={Nom}
                            required
                        />
                    </div>
                    <div className='form-group mb-6'>
                        <label htmlFor="InputPrenom" className="form-label inline-block mb-2 text-gray-700">Votre prénom</label>
                        <input
                            id="InputPrenom"
                            className={style}
                            onChange={onChange}
                            type='text'
                            placeholder='Prénom'
                            name='Prenom'
                            value={Prenom}
                            required
                        />
                  </div>
                  <div className='form-group mb-6'>
                        <label htmlFor="InputEmail" className="form-label inline-block mb-2 text-gray-700">Adresse Mail</label>
                        <input
                            id="InputEmail"
                            className={style}
                            onChange={onChange}
                            type='email'
                            placeholder='Addresse mail'
                            name='Email'
                            value={Email}
                            required
                        />
                    </div>                                                                                            
                    <div className='form-group mb-6'>
                        <label htmlFor="InputPassword" className="form-label inline-block mb-2 text-gray-700">Mot de passe</label>
                        <input
                            id="InputPassword"
                            className={style}
                            onChange={onChange}
                            type='password'
                            placeholder='Mot de passe'
                            name='Password'
                            minLength='6'
                            value={Password}
                            required
                        />
                    </div>
                    <div className='form-group mb-6'>
                        <input
                            id="passwordBis"
                            className={style}
                            onChange={onChange}
                            type='password'
                            placeholder='Confirmer votre mot de passe passe'
                            name='passwordBis'
                            minLength='6'
                            value={passwordBis}
                        />
                    </div>
                    <div>
                        <select
                            id="Role"
                            name='Role'
                            className={style}
                            onChange={onChange} >
                            <option
                                value="ROLE_ADMIN"
                            >Gérant</option>
                            <option
                                value="ROLE_USER"
                            >Agents Immobiliers</option>
                        </select>
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
                      type='submit' > S'inscrire</button>
            </form>
        </div>
    </Fragment>
  );
};

export default Register;