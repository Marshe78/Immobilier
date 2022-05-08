import React, { Fragment, useState } from "react";
import axios from "utils/axios";
import * as qs from 'qs'

const Register = () => {

  const [formData, setFormData] = useState({
    Date_rdv: "",
    Annulation: false,
    Description_rdv: "",
  });

  const { Date_rdv,  Annulation, Description_rdv } = formData;

  const onChange = (e) =>
    setFormData({ ...formData, [e.target.name]: e.target.value });

  const onSubmit = async (e) => {
    e.preventDefault();
   
     console.log(formData);
      const newUser = {
        Date_rdv,
        Annulation,
        Description_rdv,
      };
      try {
        const body = qs.stringify(newUser);
        const res = await axios.post("/rendezvous", body);
        console.log(res.data);
      } catch (err) {
        console.error(err.response.data);
      }
    };
    

  const style = "form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none";

  return (
        <Fragment>
            <div className="block mt-6 m-auto p-6 rounded-lg shadow-lg bg-white max-w-sm">
        
            <h1 className='large text-primary'>Faire une demande de rendez-vous :</h1>
            <form className='form' onSubmit={(e) => onSubmit(e)}>
                    <div className='form-group mb-6'>
                        <label htmlFor="InputDate_rdv" className="form-label inline-block mb-2 text-gray-700">Date du rendez-vous</label>
                        <input
                            id="InputDate_rdv"
                            className={style}
                            onChange={onChange}
                            type='date'
                            placeholder='Date_rdv'
                            name='Date_rdv'
                            value={Date_rdv}
                            required
                        />
                    </div>
                    <div className='form-group mb-6'>
                        <label htmlFor="InputDescription_rdv" className="form-label inline-block mb-2 text-gray-700">Décriver votre demande</label>
                        <textarea
                            id="InputDescription_rdv"
                            className={style}
                            onChange={onChange}
                            type='text'
                            placeholder='Description_rdv'
                            name='Description_rdv'
                            value={Description_rdv}
                            required
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
                      type='submit' >Envoyer</button>
            </form>
        </div>
    </Fragment>
  );
};

export default Register;