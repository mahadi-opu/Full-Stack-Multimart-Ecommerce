import React, { useRef, useEffect, useState } from "react";
import "./header.css";
import { Link, NavLink, useNavigate } from "react-router-dom";
import { userAction } from "../../redux/slices/userSlice";
import { useSelector, useDispatch } from "react-redux";
import logo from "../../../src/assets/images/img/logo-01-2.png";
import axiosClient from "../../axios-client";
import { toast } from "react-toastify";
import { getWishcount } from "../../redux/slices/settingSlice";

// import Button from '@mui/material/Button';
// import Menu from '@mui/material/Menu';
// import MenuItem from '@mui/material/MenuItem';

import { Button, Menu, MenuItem, Fade, List, ListItem, ListItemText } from "@mui/material";

import { AiFillCaretDown, AiOutlineUser } from "react-icons/ai";
import "../../styles/bottom_navigate.css"
import manueing from "../../assets/menu.svg"
import cart from "../../assets/cart.svg"
import wishlist from "../../assets/wishlist.svg"

// import { AiOutlineHeart,AiOutlineShoppingCart } from "react-icons/ai";
// import { BottomNavigationAction,BottomNavigation } from '@mui/material';
// import { AiOutlineCustomerService } from "react-icons/ai";

import MobileBottomNavbar from "./MobileBottomNavbar";
import { useQuery } from "react-query";


const nav__links = [
  {
    path: "home",
    display: "Home",
  },
  {
    path: "all/product",
    display: "Shop",
  },

  {
    path: "all/brands",
    display: "Brand",
  },
  {
    path: "contact/us/ll",
    display: "Contact",
  },
];

const Header = () => {
  const dispatch = useDispatch();
  const headerRef = useRef(null);
  const totalQuantity = useSelector((state) => state.cart.totalQuantity);
  const totalPrice = useSelector((state) => state.cart.totalAmount);
  const islogin = useSelector((state) => state.user.isLogin);
  const userinfo = useSelector((state) => state.user.userInfo);
  const wishcount = useSelector((state) => state.setting.wishcount);
  // const username = islogin && JSON.parse(userinfo).name;
  const basepath = useSelector((state) => state.setting.basepath);


  const menuRef = useRef(null);
  const navigate = useNavigate();

  const [dropdownOpen, setDropdownOpen] = useState(false);

  const toggle = () => setDropdownOpen((prevState) => !prevState);

  useEffect(()=>{
    dispatch(getWishcount());
  },[])


  const [anchorEl, setAnchorEl] = useState(null)
  const open = Boolean(anchorEl);
  const handleClick = (event) => {
    setAnchorEl(event.currentTarget);
  };
  const handleClose = () => {
    setAnchorEl(null);
  };

  const [anchorEl22, setAnchorEl22] = useState(null)
  const open22 = Boolean(anchorEl22);
  const handleClick22 = (event) => {
    setAnchorEl22(event.currentTarget);
  };
  const handleClose22 = () => {
    setAnchorEl22(null);
  };

  const userLogout = () => {
    axiosClient.post("logout").then(({ data }) => {
      dispatch(userAction.logout());
      toast.success('Successfully Logout')
      navigate("/home");
    });
  };



  let [showSubcategory, setSubcategory] = useState(false);
  let [subcategory, setSubcatListegory] = useState([]);
  const categoryList = useQuery('categorylist', async () => await axiosClient.get('product/category').then(({ data }) => data));



  const menuToggle = () => menuRef.current.classList.toggle("active__menu");
  const navigateToCart = () => {
    navigate("/cart");
  };
  let [srcname, setsrcname] = useState();

  let [srcProductList, setSrcProductList] = useState([]);

  let searchProduct = (name) => {
    setsrcname(name);
    axiosClient.get(`search/product?name=${name}`).then(({ data }) => {
      if (name) {
        setSrcProductList(data);
      } else {
        setSrcProductList([]);
      }
    });
  };

  let subcategoryset = (categoryId) => {
    axiosClient
      .get(`category/wise/subcategory?category_id=${categoryId}`)
      .then(({ data }) => {
        setSubcatListegory(data);
        if (data.length > 0) {
          setSubcategory(true);
        }
      });
  };

  let srcInputname = (name) => {
    setsrcname(name);
    setSrcProductList([]);
  };

  return (
    <>
      {/* Header Top Strip  */}

      <MobileBottomNavbar />


      <header className="header-top-strip py-2">
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-6 col-md-6">
              <div className="text-center text-md-start m-3 m-md-0">
                {/* <p className="text-white">  Free Shipping Over $100 & Free Ruturns  </p> */}
                <p className="text-white"> Hotline:{" "}
                  <a className="text-white" href="tel:+88 01924224778"> {" "} +88 01924224778{" "}</a>
                </p>
              </div>
            </div>
            <div className="col-lg-6 col-md-6">
              <div className="text-center text-md-end">


                <div className="my__account userst">
                  {islogin ? (
                    <div
                      className="d-flex align-items-center  text-white"
                      to={"/login"}
                    >

                      <div className="userimgdiv"><span className="userimg"><AiOutlineUser /></span></div>


                      <div className="dropdown">
                        <div>
                          <Button
                            id="fade-button2"
                            aria-controls={open22 ? 'fade-menu3' : undefined}
                            aria-haspopup="true"
                            aria-expanded={open22 ? 'true' : undefined}
                            className="username"
                            onClick={handleClick22}
                          >
                            {islogin && JSON.parse(userinfo).name}
                            <span className="userdropicon"><AiFillCaretDown /></span>
                          </Button>
                        </div>
                      </div>

                    </div>
                  ) : (
                    <div className="d-flex align-items-center gap-10 text-white">
                      <Link to={"/login"}> 
                        <p className="mb-0"> Login </p>
                      </Link> |
                      <Link to="/Signup">  
                        <p className="mb-0 text-white"> Sign Up </p>
                      </Link>
                    </div>

                  )}
                  <Menu
                    id="fade-menu3"
                    // MenuListProps={{
                    //   'aria-labelledby': 'fade-button2',
                    // }}
                    anchorEl={anchorEl22}
                    open={open22}
                    onClose={handleClose22}
                    TransitionComponent={Fade}
                  >
                    <Link
                      to={"/user/deshboard/1"}
                    >
                      <MenuItem onClick={handleClose22}>Profile</MenuItem>
                    </Link>

                    {/* <MenuItem onClick={handleClose}>My account</MenuItem> */}
                    <MenuItem onClick={userLogout}>Logout</MenuItem>
                  </Menu>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>

      {/* Header Middle Start  */}
      <header className="header-middle py-2">
        <div className="container">
          <div className="row align-items-center gx-3">

            <div className="col-lg-3 col-md-3">
              <div className="logo">
                <Link to={"/"}>
                  <img src={logo} alt="logo" />
                </Link>
              </div>
            </div>

            <div className="col-lg-6 col-md-6">
              <div className="search-group position-relative">
                <input
                  onChange={(e) => {
                    searchProduct(e.target.value);
                  }}
                  value={srcname}
                  type="text"
                  className=""
                  placeholder="Serach Product Here..."
                  aria-label="Serach Product Here..."
                  aria-describedby="basic-addon2"
                />
                <span className="search-icon" id="basic-addon2">
                  <i className="ri-search-line fs-6"></i>
                </span>

                {srcProductList.length > 0 && (
                  <ul className="srcitem">
                    {srcProductList.map((data, index) => (
                      <Link
                        to={`/shop/${data.id}`}
                        className="linkst"
                        onClick={() => srcInputname(data.name)}
                      >
                        <li className="srcItem">{data.name}</li>
                      </Link>
                    ))}
                  </ul>
                )}
              </div>
            </div>

            <div className="col-lg-3 col-md-3 wish_cart">
              <div className="header-middle-links">

                <div className="wishlist">
                  <Link className="d-flex align-items-center gap-10 text-white"
                    to={"/product/wishlist"} >
                    {/* <AiOutlineHeart className="headerIcondesign"/> */}


                    <img src={wishlist} alt="wishlist" />
                    <div>
                      <span
                        className="badge bg-white text-dark cardamount"
                        onClick={navigateToCart}
                      >
                        {wishcount}
                      </span>
                      <p className="mb-0"> {" "}  Wishlist{" "} </p>
                    </div>


                  </Link>

                  {/* <SimpleListMenu/> */}
                </div>
                <SimpleListMenu total={totalQuantity} />

              </div>
            </div>

          </div>
        </div>
      </header>

      {/* Header Bottom Start  */}
      <header className="header-bottom py-2">
        <div className="container">
          <div className="row align-items-center">

            <div className="col-lg-3 col-md-3">

              <div className="dropdown">
                <div className="drpMenuItem custopdropdown">
                  <Button
                    id="fade-button"
                    aria-controls={open ? 'fade-menu' : undefined}
                    aria-haspopup="true"
                    aria-expanded={open ? 'true' : undefined}
                    className="username"
                    onClick={handleClick}
                  >
                    <img src={manueing} alt="Menu" />  Shop Categories   <span className="userdropicon"><AiFillCaretDown /></span>
                  </Button>
                  <Menu
                    id="fade-menu"
                    MenuListProps={{
                      'aria-labelledby': 'fade-button',
                    }}
                    anchorEl={anchorEl}
                    open={open}
                    onClose={handleClose}
                    TransitionComponent={Fade}
                    className="cartlistitem"

                  >

                    {categoryList.isLoading == false && categoryList.data.map((value, index) => {
                      return <MenuItem className="categoryList__st itemstyle--set"
                        onClick={() => subcategoryset(value.id)}
                        onMouseLeave={() => setSubcategory(false)}
                        style={{ width: '300px' }}

                      >
                        <img className="categoryimgdown" src={`${basepath}/${value.image}`} alt="" />
                        <div>
                          {value.name}
                        </div>
                      </MenuItem>
                    })}

                    {showSubcategory && <div className="subcategory__list__st"

                      onMouseEnter={() => setSubcategory(true)}
                      onMouseLeave={() => setSubcategory(false)}
                    >
                      <ul>
                        {subcategory.map((value, index) => {
                          return (
                            <Link
                              to={`/products/list/${value.category_id}/${value.id}/0/0/0`}
                              className="liststyle"
                            >
                              <li className="box d-flex itemstyle--set" key={index}>
                                <span>{value.name} </span>
                              </li>{" "}
                            </Link>
                          );
                        })}
                      </ul>
                    </div>}


                  </Menu>


                </div>
              </div>
            </div>

            <div className="col-lg-9 col-md-9">
              <div className="menu-links m-0"
                ref={menuRef}
                onClick={menuToggle}
              >
                <ul>
                  {nav__links.map((item, index) => (
                    <li className="nav__item" key={index}>
                      <NavLink
                        to={item.path}
                        className={(navClass) =>
                          navClass.isActive ? "nav__active" : ""
                        }
                      >
                        {item.display}
                      </NavLink>
                    </li>
                  ))}
                </ul>

              </div>
            </div>

          </div>
        </div>
      </header>
    </>
  );
};




// const SimpleBottomNavigation=()=>{
//   const [value, setValue] = React.useState('recents');

//   const handleChange = (event, newValue) => {
//     setValue(newValue);
//   };

//   return (

//     <div class="navbar">
//     <a href="#home" class="active"><AiOutlineHome/> Home</a>
//     <a href="#news"><BsSuitHeart/> Wish List</a>
//     <a href="#contact"><AiOutlineShoppingCart/> Cart</a>
//     <a href="#contact"><BsPersonCircle/> Account</a>
//   </div>
//     );
// }


const SimpleListMenu = (props) => {
  const [anchorEl, setAnchorEl] = React.useState(null)
  const [selectedIndex, setSelectedIndex] = React.useState(1);
  const basepath = useSelector((state) => state.setting.basepath);
  const open = Boolean(anchorEl);

  const cartItems = useSelector((state) => state.cart.cartItems);

  const options = [
    'Show some love to MUI',
    'Show all notification content',
    'Hide sensitive notification content',
    'Hide all notification content',
  ];
  const handleClickListItem = (event) => {
    setAnchorEl(event.currentTarget);
  };

  const handleMenuItemClick = (
    event,
    index,
  ) => {
    setSelectedIndex(index);
    setAnchorEl(null);
  };

  const handleClose = () => {
    setAnchorEl(null);
  };

  return (
    <div>
      <List
        component="nav"
        aria-label="Device settings"
      // sx={{ bgcolor: 'background.paper' }}
      >
        <span
          // id="lock-button"
          // aria-haspopup="listbox"
          // aria-controls="lock-menu"
          // aria-expanded={open ? 'true' : undefined}
          onClick={handleClickListItem}
        >
          <div className="cart__list" style={{ cursor: "pointer" }}>

            <div
              className="d-flex align-items-center gap-10 text-white"

            >
              <img src={cart} alt="Cart" />
              {/* <AiOutlineShoppingCart className="headerIcondesign"/> */}
              <div className="d-flex flex-column">
                <span
                  className="badge bg-white text-dark cardamount"
                // onClick={navigateToCart}
                >
                  {props.total}
                </span>
                <b />
                <p className="mb-0">
                  Cart
                  {/* ${totalPrice} */}
                </p>
              </div>
            </div>
          </div>
        </span>
      </List>
      <Menu
        id="lock-menu"
        anchorEl={anchorEl}
        open={open}
        onClose={handleClose}
        MenuListProps={{
          'aria-labelledby': 'lock-button',
          role: 'listbox',
        }}
      >


        <div className="cartdropwidth">
          {cartItems.map((item, index) => {
            return (

              <MenuItem className="cartdwnsst" style={{ width: '300px', dispatch: "flex", flexWrap: 'wrap', gap: "2px", border: '1px solid rgb(243 236 236 / 45%)' }}>
                <div style={{ flexBasis: "30%", position: "relative" }}>
                  <span className="itmqty_sp">{item.quantity}</span>
                  <img
                    className="item__img"
                    src={`${basepath}/${item.imgUrl}`}
                    alt=""
                  />
                </div>
                <div style={{ flexBasis: "65%" }}>
              
                  {item.productName&&item.productName.length > 15 ? item.productName.slice(0, 15) + '..' : item.productName}
                  <br />
                  <p>{item.price * item.quantity}</p>


                </div>
                {/* <div style={{ flexBasis: "10%" }}>
                    {item.price * item.quantity}
                  </div> */}
              </MenuItem>
            );
          })}
          <Link to={"/checkout"} className="w-100">
            <MenuItem className="bottomdivst d-flex justify-content-center" style={{
              background: "red", background: '#c22026', marginBottom: '-8px',
              color: 'white'
            }}>Checkout</MenuItem>
          </Link>
        </div>




      </Menu>
    </div >
  );
}


export default Header;
