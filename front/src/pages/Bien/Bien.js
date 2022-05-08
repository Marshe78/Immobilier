import React, {useState, useEffect} from 'react'
import axios from "utils/axios";
import { useLocation } from 'react-router-dom';
import * as qs from 'qs'

/*let data = {
    Id_bien: 12, Image_bien : "data:image/jpeg;base64,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",
     Adresse: '12 rue Boulbix', Ville: "Sqy", Type_bien: "Maison", Proprietaire:"Jean-Luc", Superficie:"43", NbPiece: 43, Prix: "1500", Paiement: "Location", Status_bien: "Dispo",
};*/

export default function Bien({getToken, Role, Id}) {
    
    const [Adminbien, setAdmin] = useState(false);
    const [loader, setLoader] = useState(true);
    const [hasError, setError] = useState(false);
    // Get the path
    const location = useLocation();
    const id = location.pathname.substring(location.pathname.lastIndexOf('/') + 1);// id inside path
    const User = (getToken() !== null && Role === 'ROLE_USER') ? true : false;
    const AdminUser = (getToken() !== null && Role === 'ROLE_ADMIN') ? true : false;
    

    const [val, setVal] = useState({
        Prix: "",
        Adresse: "",
        Ville: "",
        Proprietaire: "",
        NbPiece: "",
        Paiement: "", 
        Status_bien: ""

    });

    const { Id_bien, Image_bien, Adresse, Ville, Type_bien, Proprietaire, Superficie, NbPiece, Prix, Paiement, Status_bien } = val;

    
    const onChange = (e) =>
        setVal({ ...val, [e.target.name]: e.target.value });
   
    
    const onSubmit = async (e) => {
        e.preventDefault();
        console.log(val);
        const updateBien = {
            Id_bien, Image_bien, Adresse, Ville, Type_bien, Proprietaire, Superficie, NbPiece, Prix, Paiement, Status_bien
        };
        try {
            const settings = {
                headers: {
                    "Token": getToken()
                }
            };
            const body = qs.stringify(updateBien);
            console.log(updateBien)
            const res = await axios.put(`/bien/${id}`, body, settings);
            console.log(res);
      } catch (err) {
        console.error(err.response.data);
      }
    }

    const deleteBien = async () => {
        try {
            const res = await axios.delete(`/bien/${id}`);
            console.log(res);
      } catch (err) {
        console.error(err.response.data);
      }
    }

    useEffect(() => {
        const getData = async () => {
            try {
                const res = await axios.get(`/bien/${id}`);
                console.log(res.data);
                setVal(res.data)
                if (AdminUser || User) {
                    const getAdminbien = async () => {
                        try {
                            const { data } = await axios.get(`/gerer/${Id}`);
                            if(User)
                                data.includes(parseInt(id)) ? setAdmin(true) : setAdmin(false);
                            else
                                setAdmin(true)
                            
                            setLoader(false);
                        } catch (err) {
                            console.error(err.response.data);
                            setError(true);
                        }
                    };
                    getAdminbien();
                }
                else {
                    setLoader(false);
                }
            } catch (err) {
                console.error(err.response.data);
                setError(true);
            }
        };
        getData();
    }, []);

    if (loader) {
        return (
            <div className="center"><div className="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>
        )
    }
    else if (hasError) {
        return (
            <div className="error flex justify-center">
                Erreur lors du chargement
            </div>
        );
    } else if (Adminbien){
        //on fetch la data...

        return (
            <div className="bien-container">
                <form className='form' onSubmit={(e) => onSubmit(e)}>
                <h1> <input
                            id="InputNbPiece"
                            onChange={onChange}
                            type='number'
                            placeholder='NbPiece'
                            name='NbPiece'
                            value={NbPiece}
                            disabled={Adminbien ? '' : true}
                            Style="width: 50px"
                        
                    />pièces <input
                            id="InputSuperficie"
                            onChange={onChange}
                            type='number'
                            placeholder='Superficie'
                            name='Superficie'
                            value={Superficie}
                            disabled={Adminbien ? '' : true}
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
                            disabled={Adminbien ? '' : true}
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
                            disabled={Adminbien ? '' : true}
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
                            disabled={Adminbien ? '' : true}
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
                            disabled={Adminbien ? '' : true}
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
                            disabled={Adminbien ? '' : true}
                            Style="width: 100px"
                        />
                        </div>
                        {Adminbien && ( 
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
                        </div>)}
                        <div>
                            {Adminbien && (<button
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
                                        type='submit' >Appliquer les modifications</button>)}
                        </div>
                    </div>
                </form>
                <div>
                {Adminbien && (<button
                    onClick={deleteBien}
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
                            type='' >Supprimer</button>)}
                        </div>
            </div>
        );
    }else{
        return (
            <div className="bien-container">
                <h1>{Type_bien} {NbPiece} pièces {Superficie}m²</h1>
                <div className="image-bien">
                    <img src={Image_bien} alt="" />
                </div>
                <div className="labels-ct">
                    
                    <div>
                        <svg width="2em" height="2em" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="32" d="M256 48c-79.5 0-144 61.39-144 137c0 87 96 224.87 131.25 272.49a15.77 15.77 0 0 0 25.5 0C304 409.89 400 272.07 400 185c0-75.61-64.5-137-144-137Z"></path><circle cx="256" cy="192" r="48" fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="32"></circle></svg>
                        <span>{Ville}, {Adresse}</span>
                    </div>

                    <div>
                        <svg width="2em" height="2em" viewBox="0 0 36 36"><path fill="currentColor" d="M31.48 28.49a1 1 0 0 0-1.38-.32A12 12 0 0 1 12.45 22h11.71a1 1 0 0 0 0-2H11.93a11.16 11.16 0 0 1 0-4h12.23a1 1 0 0 0 0-2H12.45a12 12 0 0 1 17.61-6.2a1 1 0 0 0 1.06-1.7A14 14 0 0 0 10.34 14h-6.8a1 1 0 1 0 0 2h6.37a14 14 0 0 0-.16 2a14 14 0 0 0 .16 2H3.54a1 1 0 1 0 0 2h6.8a14 14 0 0 0 20.83 7.87a1 1 0 0 0 .31-1.38Z" className="clr-i-outline clr-i-outline-path-1"></path><path fill="none" d="M0 0h36v36H0z"></path></svg>
                        <span>{Prix}€</span>
                    </div>

                    <div>
                        <svg width="2em" height="2em" viewBox="0 0 256 256"><path fill="currentColor" d="M240 208h-16v-92.5a16 16 0 0 0-5.2-11.8l-80-72.7a16 16 0 0 0-21.6 0l-80 72.7a16 16 0 0 0-5.2 11.8V208H16a8 8 0 0 0 0 16h224a8 8 0 0 0 0-16ZM48 115.5l80-72.7l80 72.7V208h-48v-48a16 16 0 0 0-16-16h-32a16 16 0 0 0-16 16v48H48Zm96 92.5h-32v-48h32Z"></path></svg>
                        <span>{Type_bien}</span>
                    </div>

                    <div>
                        <svg width="2em" height="2em" viewBox="0 0 256 256"><path fill="currentColor" d="M231.9 212a120.7 120.7 0 0 0-67.1-54.2a72 72 0 1 0-73.6 0A120.7 120.7 0 0 0 24.1 212a8 8 0 1 0 13.8 8a104.1 104.1 0 0 1 180.2 0a8 8 0 1 0 13.8-8ZM72 96a56 56 0 1 1 56 56a56 56 0 0 1-56-56Z"></path></svg>
                        <span>{Proprietaire}</span>
                    </div>

                    <div>
                        <svg width="2em" height="2em" viewBox="0 0 32 32"><path fill="currentColor" d="M14 5v2h9.563L7 23.563V14H5v13h13v-2H8.437L25 8.437V18h2V5H14z"></path></svg>
                        <span>{Superficie}m²</span>
                    </div>

                    <div>
                        <svg width="2em" height="2em" viewBox="0 0 16 16"><path fill="currentColor" d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2l-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504L1.508 9.071l2.742 1.567l2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134l2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996l2.742 1.567l2.742-1.567l-2.742-1.567l-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643L8 4.21l2.742-1.567L8 1.076L5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z"></path></svg>
                        <span>{NbPiece} pièces</span>
                    </div>

                </div>
            </div>
        );

    }
}