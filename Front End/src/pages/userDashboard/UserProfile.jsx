import React, { useEffect, useState } from "react";
import Helmet from "../../components/Helmet/Helmet";
import { Link } from "react-router-dom";
import {
  Col,
  Container,
  Form,
  FormGroup,
  Input,
  Label,
  Row,
  Button,
} from "reactstrap";

import {
  AiOutlineHeart,
  AiOutlineShopping,
  AiOutlineCheckCircle,
} from "react-icons/ai";
import { useDispatch, useSelector } from "react-redux";
import { getWishcount } from "../../redux/slices/settingSlice";
const UserProfile = (props) => {
  const dispatch=useDispatch();
  const wishcount = useSelector((state) => state.setting.wishcount);
  const totalcart = useSelector((state) => state.cart.totalQuantity);
  useEffect(()=>{
    dispatch(getWishcount());
  },[]);
  const orderlistshow=()=>{
      props.orderlist();
  }

  return (
    <Helmet title="Login">
      <section>
        <Container>
          <Row className="dashboardCard">
            <Col lg="6" className="profileCardLeft">
              <div className="roundImg">
                <img
                  src="https://weblearnbd.net/tphtml/shofy-prv/shofy/assets/img/users/user-10.jpg"
                  alt=""
                />
              </div>
              <div>
                <span className="userName">Welcome</span>
                <br />
                <span>Adrian Abir</span>
              </div>
            </Col>
            <Col lg="6" className="profileCardRigt">
              <Button variant="contained" className="logoutbtnst">
                Logout
              </Button>
            </Col>
            <Col lg="12" className="userProfile__info_data">
              <div className="profile__main-info-item" onClick={orderlistshow}>
                <span className="roundicon">0</span>
                <AiOutlineCheckCircle className="itemi__con" />
              
                <span className="iconname">Order Done</span>
              </div>
              <Link to={"/product/wishlist"}>
              <div className="profile__main-info-item">
                <span className="roundicon">{wishcount}</span>
                <AiOutlineHeart className="itemi__con" />
                <span className="iconname"> Wishlist</span>
                
              </div>
              </Link>
              <Link to={"/checkout"}>
              <div className="profile__main-info-item">
         
              <span className="roundicon">{totalcart}</span>
                <AiOutlineShopping className="itemi__con" />
                <span className="iconname">Cart</span>
             
              </div>
              </Link>
            </Col>
          </Row>
        </Container>
      </section>
    </Helmet>
  );
};

export default UserProfile;
