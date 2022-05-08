import React, {useState} from 'react'
import { BienItem } from 'components';

export default function BiensCollection({ data, getToken, Role, Id}) {

  // Url params
  const urlParams = new URLSearchParams(window.location.search);
  // ---------------------- Get Max values for filters ----------------------
  // Price
  const prixarr = [...data].map(object => {
    return object.Prix;
  });
  const maxPrix = Math.max(...prixarr);
  // m²
  const metersarr = [...data].map(object => {
    return object.Superficie;
  });
  const maxMetters = Math.max(...metersarr);
  // pieces
  const piecesarr = [...data].map(object => {
    return object.NbPiece;
  });
  const maxPieces = Math.max(...piecesarr);
   // ---------------------- Vars ----------------------
  let defautpage = 1;
  let defaultOffre = 9;
  let defaultBien = 'tous';

  // ---------------------- Seting url Params ----------------------
  if (urlParams.get('page')){
    defautpage = parseInt(urlParams.get('page'));
  }
  if (urlParams.get('offre')){
    defaultOffre = urlParams.get('offre');
  }
  if (urlParams.get('typebien')){
    defaultBien = urlParams.get('typebien');
  }

   // ---------------------- States ----------------------
  const [page] = useState(defautpage);
  const [typeOffre] = useState(defaultOffre);
  const [typeBien] = useState(defaultBien);
  const [prix, setPrix] = useState(maxPrix);
  const [meters, setMeters] = useState(maxMetters);
  const [pieces, setPieces] = useState(maxPieces);

  const returnGoodLabel = (label, val, maxval) => {
    if (val == maxval) return `${label} ${val}+`;
    return `${label} ${val}`;
  }
   // ---------------------- filters ----------------------
  const filters = [
    {key : 'Type de bien', values : ['tous', 'appartement', 'maison'], default: typeBien},
    {key : "Type d'offre", values : [{disp : 'tous', val : 9, },{disp : 'achat', val : 0, },{disp : 'location', val : 1, }], default: typeOffre},
  ];

  const filterData = () => {
    const keyVal = [
      {key: 'Status_bien', val: parseInt(typeOffre), cond: (e,v)=>{return ( parseInt(e) === parseInt(v) )}, maxv : 9},
      {key: 'Type_bien', val: typeBien, cond: (e,v)=>{return ( e.toLowerCase() === v.toLowerCase() )}, maxv : 'tous'},
      {key: 'Prix', val: parseInt(prix), cond: (e,v)=>{return ( parseInt(e) <= v ) }, maxv : maxPrix},
      {key: 'Superficie', val: parseInt(meters), cond: (e,v)=>{return ( parseInt(e) <= v ) }, maxv : maxMetters},
      {key: 'NbPiece', val: parseInt(pieces), cond: (e,v)=>{return ( parseInt(e) <= v ) }, maxv : maxPieces},
    ]
    let filtered = [...data];

    keyVal.map(e => {
      if (e.val != e.maxv) {
        filtered = [...filtered].filter(elem => e.cond(elem[e.key],e.val))
      }
    })

    return filtered;
  }

  const nBpages = Math.ceil((filterData(data).length / 12));

  const pageFoward = () => {
    if (page < nBpages) {
      urlParams.set('page', (page+1));
      window.location.search = urlParams;
    }
  }

  const pageBackward = () => {
    if (page > 1) {
      urlParams.set('page', (page-1));
      window.location.search = urlParams;
    }
  }

  const selectChange = ({target}) => {
    const  {id, value} = target;
    if (id === "0"){
      urlParams.set('typebien', value);
      return window.location.search = urlParams;
    }
    if (id === "1"){
      urlParams.set('offre', value);
      return window.location.search = urlParams;
    }
  }

  const rangeChange = ({target}) => {
    const  {id, value} = target;
    if (id === "meters") return setMeters(value);
    if (id === "prix") return setPrix(value);
    if (id === "pieces") return setPieces(value);
  }
  // Destructuring
    return (
      <div>
        <div className="filters">
          <div className="filter-ct">
            {filters.map((filter, mainindex) => {
                if (typeof filter.values[0] == 'string'){
                  return(
                    <div key={mainindex} className="element-filter">
                      <label>{filter.key}</label>
                      <select id={mainindex} defaultValue={filter.default} onChange={selectChange}>
                        {filter.values.map((option, index) => {
                            return(
                              <option value={option} key={index}>{option}</option>
                            )
                        })}
                      </select>
                    </div>
                  );
                }
                return(
                  <div key={mainindex} className="element-filter">
                    <label>{filter.key}</label>
                    <select id={mainindex} defaultValue={filter.default} onChange={selectChange}>
                      {filter.values.map((option, index) => {
                          return(
                            <option value={option.val} key={index}>{option.disp}</option>
                          )
                      })}
                    </select>
                  </div>
                );
                
              })}
            </div>

            <div className="filter-ct">
              <div className="element-filter">
                <label>{returnGoodLabel('Superficie', meters, maxMetters)}</label>
                <input type="range" id="meters" name="meters" min="0" max={maxMetters} defaultValue={maxMetters} onMouseUp={rangeChange}></input>
              </div>
              <div className="element-filter">
                <label>{returnGoodLabel('Prix',prix, maxPrix)}</label>
                <input type="range" id="prix" name="prix" min="0" max={maxPrix} defaultValue={maxPrix} onMouseUp={rangeChange}></input>
              </div>
              <div className="element-filter">
                <label>{returnGoodLabel('Pièces',pieces, maxPieces)}</label>
                <input type="range" id="pieces" name="pieces" min="0" max={maxPieces} defaultValue={maxPieces} onMouseUp={rangeChange}></input>
              </div>
            </div>

        </div>
      
        <div className="center">
          <div className="biens-ct">
            {filterData(data).slice(((page - 1) * 12),(page * 12)).map(e => {
              return (
                  <BienItem data={e} key={e.Id_bien} getToken={getToken} Role={Role} Id={Id} />
              );
            })}
          </div>
        </div>
        <div className="arrows-container">
            <div onClick={pageBackward} style={{cursor: 'pointer'}}>
              <svg width="2em" height="2em" viewBox="0 0 24 24"><path fill="currentColor" d="M17.59 18L19 16.59L14.42 12L19 7.41L17.59 6l-6 6z"></path><path fill="currentColor" d="m11 18l1.41-1.41L7.83 12l4.58-4.59L11 6l-6 6z"></path></svg>
            </div>
            <span>{page}/{nBpages}</span>
            <div onClick={pageFoward} style={{cursor: 'pointer'}}>
              <svg width="2em" height="2em" viewBox="0 0 24 24"><path fill="currentColor" d="M6.41 6L5 7.41L9.58 12L5 16.59L6.41 18l6-6z"></path><path fill="currentColor" d="m13 6l-1.41 1.41L16.17 12l-4.58 4.59L13 18l6-6z"></path></svg>
            </div>
          </div>
      </div>
    );

  }