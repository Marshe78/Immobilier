

import './App.css';
import { Menu } from "components";
import { Routes, Route} from 'react-router-dom'
import { AddBien, Biens, Bien, Login, Register, Logout, Home, Rdv, Dashboard } from 'pages';
import useToken from 'components/App/useToken';

const App = () => {
  const { setToken, getToken, resetToken, decodeToken } = useToken();
  const Btoken = getToken() !== null ? true : false;
  const tokenDecoder = decodeToken();
  const {Role, Id} = tokenDecoder !== null ? tokenDecoder : "";

  return (
    <>
      <Menu Btoken={Btoken} Role={Role}/>
      <Routes>
          <Route index  path="/" element={<Home getToken={getToken} Role={Role} Id={Id}/>}/>
          
          <Route path="/biens" element={<Biens getToken={getToken} Role={Role} Id={Id}/>} />
          <Route path="/addbien" element={<AddBien getToken={getToken} Role={Role} Id={Id}/>} />
          <Route path="/bien/:id" element={<Bien getToken={getToken} Role={Role} Id={Id} />} />
        
          <Route path="/rdv" element={<Rdv />} />
          <Route path="/dashboard" element={<Dashboard getToken={getToken} Role={Role} Id={Id}/>} />
        
          <Route path="/register" element={<Register getToken={getToken} ROLE={Role} />} />
          <Route path="/login" element={<Login setToken={setToken} getToken={getToken} />} />
          <Route path="/logout" element={<Logout resetToken={resetToken} />} />
        
          <Route path="*" element={<div>404 Page Not Found</div>} />
      </Routes>
    </>
  );
}

export default App;


