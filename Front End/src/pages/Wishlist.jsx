import React, { useEffect, useState } from 'react'
import Helmet from '../components/Helmet/Helmet'
import { Accordion, AccordionBody, AccordionHeader, AccordionItem, Form, FormGroup, Input, Label } from 'reactstrap';
import CommonSection from '../components/UI/CommonSection'
import '../styles/shop.css';
import { Col, Container, Row } from 'reactstrap';
import Categories from '../components/Categories/Categories';
import Subcategorys from '../components/Subcategory/Subcategory';

import products from '../assets/data/products';
import ProductsList from '../components/UI/ProductsList';
import FlexProductsList from '../components/UI/FlexProductList';
import { useParams } from 'react-router-dom';
import axiosClient from '../axios-client';
import GeneralProductList from '../components/UI/GeneralProductList';

const WishList = () => {
    const [wishlist,setWishList]=useState([]);
    useEffect(()=>{
        axiosClient
        .get('user/wish/get')
        .then(({ data }) => {
            setWishList(data.data)
        });
    },[])

    return (
        <Helmet title='Shop'>
            {/* <CommonSection title={'Products'}/> */}
                <Container>
                    <Row>
                        <Col lg="12" md="12">
                            <div className="main-products-wrapper">
                            
                                <div className='main-products'>

                                    <section className='new__arrivals'>
                                        <Container>
                                            <Row className='productlistCard'>
                                                <Col lg='12'>
                                                    <div className='d-flex justify-content-between mb-1 btmborder__st'>
                                                        <div className="section__title">
                                                            <h3> Wish List</h3>
                                                        </div>
                                                    </div>
                                                </Col>
                                                <Col lg='12'>
                                                    <GeneralProductList data={wishlist} />
                                                </Col>
                                            </Row>
                                        </Container>
                                    </section>
                                </div>
                            </div>
                        </Col>
                    </Row>
                </Container>

   
        </Helmet>
    )
};

export default WishList;