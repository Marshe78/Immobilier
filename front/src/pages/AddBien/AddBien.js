import React, {useState} from 'react'
import axios from "utils/axios";
import * as qs from 'qs'


export default function Bien({getToken, Role, Id}) {
    
    //const [Adminbien, setAdmin] = useState(false);
    //const [loader, setLoader] = useState(true);
    //const [hasError, setError] = useState(false);
    // Get the path
    //const location = useLocation();
    //const id = location.pathname.substring(location.pathname.lastIndexOf('/') + 1);// id inside path
    //const AdminUser = (getToken() !== null && Role === 'ROLE_ADMIN') ? true : false;
    

    const [val, setVal] = useState({
        Image_bien: "",
        Adresse: "",
        Ville: "",
        Type_bien: "",
        Proprietaire: "", 
        NbPiece: "",
        Superficie: "",
        Status_bien: "",
        Prix: "",
    });

    const { Id_bien, Image_bien, Adresse, Ville, Type_bien, Proprietaire, Superficie, NbPiece, Prix, Paiement, Status_bien, Token} = val;

    const onChange = (e) =>
        setVal({ ...val, [e.target.name]: e.target.value });
   
    
    const onSubmit = async (e) => {
        e.preventDefault();
        console.log(val);
        const updateBien = {
            Id_bien, Image_bien, Adresse, Ville, Type_bien, Proprietaire, Superficie, NbPiece, Prix, Paiement, Status_bien, Token
        };
        try {
            const settings = {
                headers: { 
                    'Token': getToken(), 
                },
            };
            const body = qs.stringify(updateBien);
            const res = await axios.post(`/bien`, body, settings);
            console.log(res);
      } catch (err) {
        console.error(err.response.data);
      }
    }

    return (
        <>
            <div className="bien-container">
            <form className='form' onSubmit={(e) => onSubmit(e)}>
            <h1> <input
                        id="InputNbPiece"
                        onChange={onChange}
                        type='number'
                        placeholder='NbPiece'
                        name='NbPiece'
                        value={NbPiece}
                        Style="width: 50px"
                    
                />pièces <input
                        id="InputSuperficie"
                        onChange={onChange}
                        type='number'
                        placeholder='Superficie'
                        name='Superficie'
                        value={Superficie}
                        Style="width: 70px"

                />{}m²</h1>
            <div className="image-bien">
                <img src={Image_bien} alt="" />
            </div>
            <div className="labels-ct">
                <div>
                    <svg width="2em" height="2em" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="32" d="M256 48c-79.5 0-144 61.39-144 137c0 87 96 224.87 131.25 272.49a15.77 15.77 0 0 0 25.5 0C304 409.89 400 272.07 400 185c0-75.61-64.5-137-144-137Z"></path><circle cx="256" cy="192" r="48" fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="32"></circle></svg>
                    <input
                        id="InputVille"
                        onChange={onChange}
                        type='text'
                        placeholder='Ville'
                        name='Ville'
                        value={Ville}
                        Style="width: 100px"
                            
                    />
                    </div>
                    <div>
                    <svg width="2em" height="2em" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="32" d="M256 48c-79.5 0-144 61.39-144 137c0 87 96 224.87 131.25 272.49a15.77 15.77 0 0 0 25.5 0C304 409.89 400 272.07 400 185c0-75.61-64.5-137-144-137Z"></path><circle cx="256" cy="192" r="48" fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="32"></circle></svg>
                    <input
                        id="InputAdresse"
                        onChange={onChange}
                        type='text'
                        placeholder='Adresse'
                        name='Adresse'
                        value={Adresse}
                        Style="width: 100px"
                            
                    />
                </div>
                <div>
                    <svg width="2em" height="2em" viewBox="0 0 36 36"><path fill="currentColor" d="M31.48 28.49a1 1 0 0 0-1.38-.32A12 12 0 0 1 12.45 22h11.71a1 1 0 0 0 0-2H11.93a11.16 11.16 0 0 1 0-4h12.23a1 1 0 0 0 0-2H12.45a12 12 0 0 1 17.61-6.2a1 1 0 0 0 1.06-1.7A14 14 0 0 0 10.34 14h-6.8a1 1 0 1 0 0 2h6.37a14 14 0 0 0-.16 2a14 14 0 0 0 .16 2H3.54a1 1 0 1 0 0 2h6.8a14 14 0 0 0 20.83 7.87a1 1 0 0 0 .31-1.38Z" className="clr-i-outline clr-i-outline-path-1"></path><path fill="none" d="M0 0h36v36H0z"></path></svg>
                    <input
                        id="InputPrix"
                        onChange={onChange}
                        type='number'
                        placeholder='Prix'
                        name='Prix'
                        value={Prix}
                        Style="width: 100px"
                            
                    />
                </div>

                <div>
                    <svg width="2em" height="2em" viewBox="0 0 256 256"><path fill="currentColor" d="M240 208h-16v-92.5a16 16 0 0 0-5.2-11.8l-80-72.7a16 16 0 0 0-21.6 0l-80 72.7a16 16 0 0 0-5.2 11.8V208H16a8 8 0 0 0 0 16h224a8 8 0 0 0 0-16ZM48 115.5l80-72.7l80 72.7V208h-48v-48a16 16 0 0 0-16-16h-32a16 16 0 0 0-16 16v48H48Zm96 92.5h-32v-48h32Z"></path></svg>
                    <input
                        id="InputType_bien"
                        onChange={onChange}
                        type='text'
                        placeholder='Type_bien'
                        name='Type_bien'
                        value={Type_bien}
                        Style="width: 100px"
                            
                    />
                </div>

                <div>
                    <svg width="2em" height="2em" viewBox="0 0 256 256"><path fill="currentColor" d="M231.9 212a120.7 120.7 0 0 0-67.1-54.2a72 72 0 1 0-73.6 0A120.7 120.7 0 0 0 24.1 212a8 8 0 1 0 13.8 8a104.1 104.1 0 0 1 180.2 0a8 8 0 1 0 13.8-8ZM72 96a56 56 0 1 1 56 56a56 56 0 0 1-56-56Z"></path></svg>
                    <input
                        id="InputPaiement"
                        onChange={onChange}
                        type='text'
                        placeholder='Proprietaire'
                        name='Proprietaire'
                        value={Proprietaire}
                        Style="width: 100px"
                    />
                    </div>
                    
                    <div>
                        <svg  width="32" height="32" viewBox="0 0 20 20"><path fill="currentColor" d="M17.354 2.647a2.621 2.621 0 0 0-3.707 0l-5.5 5.5a.5.5 0 0 0-.132.232l-1 4a.5.5 0 0 0 .606.606l4-1a.5.5 0 0 0 .233-.131l5.5-5.5a2.621 2.621 0 0 0 0-3.707Zm-1.41 6.53a6 6 0 1 1-5.121-5.121l.854-.854a7 7 0 1 0 5.121 5.121l-.854.854Z"></path></svg>
                        <select
                            id="SelectStatus_bien"
                            name='Status_bien'
                            onChange={onChange} >
                            <option
                                value="0"
                            >A vendre</option>
                            <option
                                value="1"
                            >A louer</option>
                            <option
                                value="2"
                            >Vendu</option>
                            <option
                                value="3"
                            >Acheté</option>
                        </select>
                    </div>
                    <div>
                        <button
                            onChange={onChange}
                            className="
                            m-3
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
                            type='submit' >Enregistrer le bien</button>
                    </div>
                </div>
            </form>
            <div>
          
            </div>
            </div>
        </>
    );
}