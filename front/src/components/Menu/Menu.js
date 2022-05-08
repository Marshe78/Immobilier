//import PropTypes from 'prop-types';
import React, { Fragment, useState } from "react";
import { Transition } from "@headlessui/react";
//import logo from "../../logo.svg";
import { NavLink } from "react-router-dom";

function Menu({ Btoken, Role }) {

  const [isOpen, setIsOpen] = useState(false);
  return (
    <div>
      <nav className="bg-gray-700 drop-shadow-lg">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center justify-between h-16">
            <div className="flex items-center">
              <div className="flex-shrink-0">
                <NavLink to="/" >
                  <img className="h-8 w-18" src={require('../../housely.png')} alt="Workflow" />
                </NavLink>
              </div>
              <div className="hidden md:block">
                <div className="ml-10 flex items-baseline space-x-4">
                  <Links Btoken={Btoken} Role={Role}/>     
                </div>
              </div>
            </div>
            <div className="justify-end hidden md:block">
              <AuthLinks Btoken={Btoken} />
            </div>
            <div className="mr-2 flex md:hidden">
              <button
                onClick={() => setIsOpen(!isOpen)}
                type="button"
                className="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-white hover:bg-gray-700 border-solid rounded-md"
                aria-controls="mobile-menu"
                aria-expanded="false"
              >
                <span className="sr-only">Open main menu</span>
                {!isOpen ? (
                  <svg
                    className="block h-6 w-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    aria-hidden="true"
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth="2"
                      d="M4 6h16M4 12h16M4 18h16"
                    />
                  </svg>
                ) : (
                  <svg
                    className="block h-6 w-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    aria-hidden="true"
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth="2"
                      d="M6 18L18 6M6 6l12 12"
                    />
                  </svg>
                )}
              </button>
            </div>
          </div>
        </div>

        <Transition
          show={isOpen}
          enter="transition ease-out duration-100 transform"
          enterFrom="opacity-0 scale-95"
          enterTo="opacity-100 scale-100"
          leave="transition ease-in duration-75 transform"
          leaveFrom="opacity-100 scale-100"
          leaveTo="opacity-0 scale-95"
        >
            <div className="md:hidden" id="mobile-menu">
              <div  className="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <Links Btoken={Btoken} isMobile={true} Role={Role}/>
              </div>
            </div>
        </Transition>
      </nav>
    </div>
  );
}

function Links({ Btoken, isMobile, Role }) {
  return (
    <Fragment>      
      <NavLink
        className="text-white hover:bg-white hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium"
        to="/biens"
      >
        Nos biens
      </NavLink>

      <NavLink
        className="text-white hover:bg-white hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium"
        to="/rdv"
      >
        Prendre rendez-vous
      </NavLink>

      {Btoken && (Role === 'ROLE_ADMIN') && (<NavLink
        className="text-white hover:bg-white hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium"
        to="/register"
      >
        Nouvel utilisateur
      </NavLink>)}

      {Btoken && (Role === 'ROLE_ADMIN' || Role === 'ROLE_USER') && (<NavLink
        className="text-white hover:bg-white hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium"
        to="/addbien"
      >
        Nouveau bien
      </NavLink>)}

      {isMobile && (<AuthLinks Btoken={Btoken} />) }
      
    </Fragment>
  );
}

function AuthLinks({Btoken}) {

  return (
    <Fragment>
      { Btoken ? (<NavLink
          className="text-white hover:bg-white hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium"
          to="/logout"
        >
          Déconnexion 
        </NavLink>) : (<NavLink
        className="text-white hover:bg-white hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium"
        to="/login"
      >
        Se connecter
      </NavLink>)}
    </Fragment>
  )
}

export default Menu;