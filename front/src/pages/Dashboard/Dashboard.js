import React, {useState, useEffect} from 'react'
import axios from "utils/axios";
import { useNavigate } from "react-router-dom";


export default function Dashboard({data, getToken, Role, Id}) {
  // Destructuring
  const {Id_bien, Image_bien, Adresse, Ville, Type_bien, Superficie, NbPiece, Prix, Status_bien,} = data;
  const navigate = useNavigate();
  const [Adminbien, setAdmin] = useState(false);
  const [loader, setLoader] = useState(true);
  const [hasError, setError] = useState(false);

  function goto(){
    navigate(`/bien/${Id_bien}`);
  }

  const Status = () => {
    return Status_bien === 0 ? "A vendre" : Status_bien === 1 ? "A louer" : Status_bien === 2 ? "Vendu" : Status_bien === 3 ? "Acheté" : "Status manquant";
  }


  useEffect(() => {
    const User = (getToken() !== null && Role === 'ROLE_USER') ? true : false;
    const AdminUser = (getToken() !== null && Role === 'ROLE_ADMIN') ? true : false;
    
    const getData = async () => {
      if (AdminUser || User) {
          const getAdminbien = async () => {
            try {
              const { data } = await axios.get(`/gerer/${Id}`);
                  if(User)
                      data.includes(parseInt(Id_bien)) ? setAdmin(true) : setAdmin(false);
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
    };
    getData();
  }, []);
  
  if (loader) {
    return (
      <div className="center"><div className="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>
    )
  }
  else {
    return (
    <div className="bien-item" onClick={goto}>
        <div className="image-ct">
        <img src={Image_bien} alt="" />
        </div>
        <div className="desc-bien">
          <div>
              <span>{Type_bien} {NbPiece} pièces {Superficie} m²</span>
              <span>{Prix}€</span>
          </div>
          <div>
              <span>{Ville},{Adresse}</span>
              <span>{Status()}</span>
          </div>
        </div>
        {Adminbien && (<div className="btn-ct mb-3">
          <button
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
          >Administrer</button>
        </div>)}
    </div>
  );
  }
}

