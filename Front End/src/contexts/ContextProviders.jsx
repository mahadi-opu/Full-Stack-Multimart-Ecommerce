import { createContext,useContext,useState} from "react";
const StateContext= createContext({
    token:null,
    apiBaseUrl:"",
    orderList:[],
    setToken: () => {},
})

export const ContextProvider=({children})=>{
    const apiBaseUrl = "http://127.0.0.1:8000/";
    const [user, setUser] = useState({});
    const [notifications, _setNotification] = useState([]);
    const [successnotifications, _setSuccessNotification] = useState([]);
    const [token, _setToken] = useState(localStorage.getItem("ACCESS_TOKEN"));
    const [orderList, _setOrder] = useState(localStorage.getItem("ORDER_LIST"));
    const [loginShow, _setloginShow] = useState(false);
    const setToken = (token) => {
        _setToken(token);
        if (token) {
          localStorage.setItem("ACCESS_TOKEN", token);
        } else {
          localStorage.removeItem("ACCESS_TOKEN");
        }
      };

     



      return (
        <StateContext.Provider
          value={{
            user,
            token,
            apiBaseUrl,
            setToken,
            orderList,
      
          }}
        >
          {children}
        </StateContext.Provider>
      );

      
}
export const useStateContext = () => useContext(StateContext);