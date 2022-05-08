import React, { useEffect, useState } from 'react';
import axios from "utils/axios";
import {BienItem} from 'components';
import { useNavigate  } from "react-router-dom";

export default function Home({ data, getToken, Role, Id }){

    const cate = [
        {name : 'Biens en Location', img : 'https://st4.depositphotos.com/1000816/i/600/depositphotos_232877454-stock-photo-cropped-image-of-estate-agent.jpg', link: '/biens?offre=1'},
        {name : "Biens a L'achat", img : 'https://www.familyhandyman.com/wp-content/uploads/2021/04/family-after-closing-on-a-house-GettyImages-503520184.jpg?fit=696,464', link: '/biens?offre=0'},
        {name : 'Appartements', img : 'https://photo.barnes-international.com/annonces/bms/111/xl/17181965645f219d33ac0973.31884369_a6028841d1_1920.jpg', link: '/biens?typebien=appartement'},
        {name : 'Maisons', img : 'https://www.maisonsdenfrancebourgogne.fr/wp-content/uploads/2018/01/slider-emeraude-comptemporaine.jpg', link: '/biens?typebien=maison'},
    ];

    const navigate = useNavigate();

    function gotoAll(){
        navigate(`/biens`);
    }
    ///biens?typebien=appartement
    function goToLink(link){
        navigate(link)
    }
    
    const [val, setVal] = useState();

    const getData = async () => {
        const {data} = await axios('/bien');
        setVal(data.reverse())
    }

    useEffect(()=>{
        getData();
    }, []);


    if (val){
        return(
            <div className="home">
                <h1><strong>Housely</strong> vous propose des biens immobiliers partout en France !</h1>

                <p>
                Notre but est de vous faciliter la vie pour trouver le bien qui vous convient, pour cela housely dispose d’un grand nombre d’agents répartis sur tout le territoire.
Pour trouver votre prochain logement, il vous suffit de naviguer parmi nos nombreux <a href="/biens">biens</a> puis de prendre <a href="/rdv">rendez-vous</a> avec l’un de nos agents, à vous de jouer !
                </p>

                <h2>Les derniers biens en ligne</h2>
                <div className="home-newItems scroll-bar">
                    {val.slice(0,5).map((e, index) => {
                        return(
                            <BienItem data={e} getToken={getToken} Role={Role} Id={Id}/>
                        )
                    })}
                </div>
                
                <h2>Découvrez nos biens</h2>
                <div className="home-cate-ct">
                    {cate.map(e => {
                        return(
                            <div className="home-cate" key={e.name} onClick={() => goToLink(e.link)}>
                                <img src={e.img} alt={e.name}/>
                                <h2>{e.name}</h2>
                            </div>
                        )
                    })}
                </div>
                <div className="btn-ct">
                    <button
                        onClick={gotoAll}
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
                         >Découvrez tous nos biens</button>
                </div>
            </div>
        )
    }

    return(
        <div>
            <div className="center"><div className="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>
        </div>
    )

}