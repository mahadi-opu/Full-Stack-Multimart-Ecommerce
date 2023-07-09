import React, {useRef, useEffect} from 'react';
import { useNavigate } from 'react-router-dom';
import './header.css';

import {Col, Container, Row } from 'reactstrap';
import {motion} from 'framer-motion';
import { useSelector } from 'react-redux';

import logo from '../../../src/assets/images/img/logo-01-01.png';
import userIcon from '../../assets/images/user-icon.png';
import Search from '../Element/Search/Search';






const SearchBar = () => {

  const headerRef = useRef (null);
  const totalQuantity = useSelector(state=> state.cart.totalQuantity);

  const menuRef = useRef (null);
  const navigate = useNavigate();

  

  const stickyHeaderFunc = () => {
    window.addEventListener("scroll", () => {
      if(
        document.body.scrollTop > 80 || 
        document.documentElement.scrollTop > 80
      ) {
        headerRef.current.classList.add("sticky__header");
      } else {
        headerRef.current.classList.remove("sticky__header")
      }
    });
  };

  useEffect(()=>{
    stickyHeaderFunc()
    return ()=> window.removeEventListener("scroll", stickyHeaderFunc);
  });

  const menuToggle = ()=> menuRef.current.classList.toggle('active__menu')
  const navigateToCart =()=>{
      navigate("/cart");
  }


  return (
    <>
        <section className='search__bar' ref={headerRef}>
            <Container>
                <Row className='d-flex align-content-center'>
                    {/* -----website Logo------ */}
                    <Col lg='3' md='3'> 
                      <div className='logo'>
                        <img src={logo} alt="logo"/>
                      </div>
                    </Col>
                    <Col lg='7' md='7'>
                      {/* ----Search--------  */}
                      <div className='category__search'>
                          <Search></Search>
                      </div>
                    </Col>
                    <Col lg='2' md='2'>
                    {/* ----Nav Icons--------  */}
                    <div className='nav__icons'>
                        <motion.span whileHover={{ scale:1.1}} className='fav__icon'>
                           <i class="ri-heart-line"></i> <span className='badge'>1</span> 
                        </motion.span>
                        <motion.span whileHover={{ scale:1.1}} className='cart__icon' onClick={navigateToCart}>
                           <i class="ri-shopping-cart-line"></i> 
                           <span className='badge'> {totalQuantity} </span>
                        </motion.span>
                        <span>
                          <motion.img src={userIcon} 
                          whileHover={{ scale:1.1}}
                          alt="userIcon"/>
                        </span>
                          {/* Mobile Menu */}
                          <div className='mobile__menu'>
                            <span onClick={menuToggle}> 
                              <i class="ri-menu-line"></i> </span>
                          </div>
                    </div>
                  </Col>
              </Row>
            </Container>   
        </section>
    </>
)
}

export default SearchBar;