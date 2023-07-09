import React, { useState } from "react";
import Helmet from "../../components/Helmet/Helmet";
import { Link } from "react-router-dom";
import { Col, Container, Form, FormGroup, Input, Label, Row } from "reactstrap";
import { useParams } from "react-router-dom";

import {
  AiOutlineProfile,
  AiOutlineUser,
  AiOutlineShoppingCart,
  AiOutlineUnlock,
} from "react-icons/ai";
import UserProfile from "./UserProfile";
import UserAddress from "./UserAddress";
import UserOrderList from "./UserOrderLIst";
import ChangePassword from "./ChangePassword";

const UserDashboard = () => {
 let {activ}= useParams()
  const [email, setEmail] = useState();
  const [password, setPassword] = useState();

  const [activeItem, setactiveItem] = useState(activ);

  const handleLoginSubmit = (e) => {
    e.preventDefault();
  };

  const submitForm = () => {
    console.log(email + " " + password);
  };

  let order=()=>{
    setactiveItem(3)
  }


  let activeitem= (activeItem==1)&& <UserProfile orderlist={order}  />|| (activeItem==2)&&<UserAddress/>||(activeItem==3)&&<UserOrderList/>||(activeItem==4)&&<ChangePassword/>
  
  return (
    <Helmet title="Login">
      <section>
        <Container>
          <Row className="dashboardCard py-3 ">
            <Col lg="3" className="login-feture py-3 cardleft">
              <ul className="card__ul">
                <li className="dashboard_item" onClick={()=>setactiveItem(1)}>
                  <span className="dashboard_item__icon">
                    <AiOutlineUser />
                  </span>
                  Profile
                </li>
                <li className="dashboard_item" onClick={()=>setactiveItem(2)}>
                  <span className="dashboard_item__icon">
                    <AiOutlineProfile />
                  </span>
                  Information
                </li>
                <li className="dashboard_item" onClick={()=>setactiveItem(3)}>
                  <span className="dashboard_item__icon" >
                    <AiOutlineShoppingCart />
                  </span>
                  My Order
                </li>
                <li className="dashboard_item" onClick={()=>setactiveItem(4)}>

                  <span className="dashboard_item__icon">
                    <AiOutlineUnlock />
                  </span>
                  Change Password
                </li>
              </ul>
            </Col>
            <Col lg="8" className="login-feture py-5 cardrigt">
              {             
             activeitem
              }

            </Col>
          </Row>
        </Container>
      </section>
    </Helmet>
  );
};

export default UserDashboard;
