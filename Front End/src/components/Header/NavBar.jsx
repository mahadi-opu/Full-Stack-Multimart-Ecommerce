
import React, {useRef} from 'react';
import { NavLink } from 'react-router-dom';
import { Col, Container, Row } from 'reactstrap';
import './header.css';



const nav__links = [
    {
      path:'home',
      display:'Home'
    },
    {
      path:'shop',
      display:'Shop'
    },
    {
      path:'cart',
      display:'Cart'
    },
    {
      path:'cart',
      display:'checkOut'
    },
    {
      path:'cart',
      display:'vendor account'
    },
    {
      path:'cart',
      display:'Track my order'
    }
  ]
  


const NavBar = () => {
  
    const menuRef = useRef (null);
    const menuToggle = ()=> menuRef.current.classList.toggle('active__menu')
    


  return (
    <>
        <section className='nav__bar'>
            <Container>
                <Row>
                <Col lg='3' md='3'>
                  <div className='catgrories'>
                      <div className='d-flex justify-content-evenly align-items-center'>
                        
                        <span><i class="ri-add-box-line"></i> </span>
                        <h4> Catgrories </h4>
                        <span> <i class="ri-arrow-down-s-line"></i> </span>

                      </div>
                  </div>
                </Col>
                <Col lg='9' md='9'>
                    <div className='d-flex justify-content-end'>
                          {/* Main Menu */}
                        <div className='navigation' ref={menuRef} onClick={menuToggle}>
                          <ul className='menu'>
                                { nav__links.map((item, index)=>(
                                        <li className="nav__item" key={index}>
                                            <NavLink to={item.path} className={(navClass)=> 
                                            navClass.isActive ? 'nav__active' : ''} >
                                            {item.display}
                                            </NavLink>
                                        </li>
                                    ))
                                }
                          </ul>
                        </div>
                          {/* End Main Menu */}
                    </div>
                </Col>
                </Row>
            </Container>
        </section>
    </>
  )
}

export default NavBar;