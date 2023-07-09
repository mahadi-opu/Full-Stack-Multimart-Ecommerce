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


const Shop = () => {
    const [productsData, setproductsData] = useState(products);

    let {category_id,subcategory_id,type}=useParams();
    let [pcategory_id,set_pcategory_id]=useState([]);
    let [subcategoryProduct,setSubcategoryProduct]=useState([]);
    let [subcategoryId,setsubcategoryId]=useState(subcategory_id);

    
    let subcategoryChange=(id)=>{
      setsubcategoryId(id);
    }
    useEffect(()=>{},[subcategoryId])


    const [open, setOpen] = useState('0');

    const toggle = (id) => {
      if (open === id) {
        setOpen();
      } else {
        setOpen(id);
      }
    };


    const handleFilter = (e) => {    
      const filterValue = e.target.value
          if (filterValue === 'sofa'){
                const filteredProducts = products.filter(
                  (item) => item.category === "sofa"
                );
                setproductsData(filteredProducts)
              }

          if (filterValue === 'mobile'){
            const filteredProducts = products.filter(
              (item) => item.category === "mobile"
            );
            setproductsData(filteredProducts)
          }

          if (filterValue === 'watch'){
            const filteredProducts = products.filter(
              (item) => item.category === "watch"
            );
            setproductsData(filteredProducts)
          }

          if (filterValue === 'wirless'){
            const filteredProducts = products.filter(
              (item) => item.category === "wirless"
            );
            setproductsData(filteredProducts)
          }
          if (filterValue === 'ascending'){
            const filteredProducts = products.filter(
              (item) => item.category === "ascending"
            );
            setproductsData(filteredProducts)
          }
          if (filterValue === 'descending'){
            const filteredProducts = products.filter(
              (item) => item.category === "descending"
            );
            setproductsData(filteredProducts)
          }
      }


      const handleSearch = e =>{
          const searchTerm = e.target.value
            const searchedProducts = products.filter(item=> item.productName.
            toLowerCase().includes(searchTerm.toLowerCase()));

            setproductsData(searchedProducts)
     }

    

  return (
    <Helmet title='Shop'>
        <CommonSection title={'Products'}/>
          <section>
              <Container>
                <Row>
                  <Col lg="3" md="3">
                    <div className='left-sidebar'>
                     <Subcategorys categoryId={category_id} subcategoryId={subcategoryId} changeSubcategory={subcategoryChange} />
                    </div>
                  </Col>
                  <Col lg="9" md="9">
                      <div className="main-products-wrapper">
                          <div className='products-filter d-flex justify-content-between align-items-center'>
                          
                              <div className="section__title grid-list">
                                    <h2> Laptop & Tablet </h2>
                              </div>

                              <div className="select-group d-flex gap-30 align-items-center">
                                <div>
                                  <Form>
                                      <FormGroup className=' d-flex gap-2 align-items-center'>
                                          <Label for="exampleSelect"> Sort By: </Label>
                                          <Input
                                            id="exampleSelect"
                                            name="select"
                                            type="select">
                                              <option> Default </option>
                                              <option>Name (A - Z)</option>
                                              <option>Name (Z - A)</option>
                                              <option>Price (Low > High)</option>
                                              <option>Price (High > Low)</option>
                                              <option>Rating (Highest)</option>
                                              <option>Rating (Lowest)</option>
                                              <option>Model (A - Z)</option>
                                              <option>Model (Z - A)</option>
                                              <option>Out Of Stock</option>
                                              <option>In Stock</option>
                                          </Input>
                                      </FormGroup>
                                  </Form>
                                </div>
                                <div>
                                  <Form>
                                      <FormGroup className='d-flex gap-2 align-items-center'>
                                          <Label for="exampleSelect"> Show: </Label>
                                          <Input
                                            id="exampleSelect"
                                            name="select"
                                            type="select">
                                              <option>20</option>
                                              <option>25</option>
                                              <option>50</option>
                                              <option>75</option>
                                              <option>100</option>
                                          </Input>
                                      </FormGroup>
                                  </Form>
                                </div>
                              </div>

                          </div>
                          <div className='main-products'>
                            <Row>
                                {
                                  productsData.length === 0 ? (<h1 className='text-center fs-4'> No Products are Found! </h1>) 
                                  : (<FlexProductsList subcategoryId={subcategoryId} type={type} />
                                  )
                                }
                            </Row>
                          </div>
                      </div>
                  </Col>
                </Row>
              </Container>

          </section>

    </Helmet>
  )
};

export default Shop;