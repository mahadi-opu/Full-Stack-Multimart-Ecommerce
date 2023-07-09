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
    let {category_id,subcategory_id,type,offer_id}=useParams();
    let [pcategory_id,set_pcategory_id]=useState([]);
    let [subcategoryProduct,setSubcategoryProduct]=useState([]);
    let [subcategoryId,setsubcategoryId]=useState(subcategory_id);

    let subcategoryChange=(id)=>{
      setsubcategoryId(id);
    }
    useEffect(()=>{
    },[subcategoryId])


    const [open, setOpen] = useState('0');

    const toggle = (id) => {
      if (open === id) {
        setOpen();
      } else {
        setOpen(id);
      }
    };

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
                    <Subcategorys categoryId={category_id} subcategoryId={subcategoryId} changeSubcategory={subcategoryChange} type={type} />   
                    </div>
                  </Col>
                  <Col lg="9" md="9">
                      <div className="main-products-wrapper">
                          <div className='products-filter d-flex justify-content-between align-items-center'>
                          
                              <div className="section__title grid-list">
                                    {/* <h2> Laptop & Tablet </h2> */}
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
                                  : (<FlexProductsList subcategoryId={subcategoryId} type={type} offerId={offer_id} />
                                  )
                                }
                            </Row>
                          </div>
                      </div>
                  </Col>
                </Row>
              </Container>

          </section>

        {/* <section>
          <Container>
            <Row>
              <Col lg="3" md="6">
                <div className='filter__widget'>
                  <select onChange={handleFilter}>
                    <option> Filter By Category </option>
                    <option value='sofa'> Sofa </option>
                    <option value='mobile'> Mobile </option>
                    <option value='chair'> Chair </option>
                    <option value='watch'> Watch </option>
                    <option value='wirless'> wirless </option>
                  </select>
                </div>
              </Col>
              <Col lg="3" md="6" className='text-end'>
                <div className='filter__widget'>
                    <select name='' id='' onChange={handleFilter}>
                      <option> Sort By </option>
                      <option value='ascending'> Ascending </option>
                      <option value='descending'> Descending </option>
                    </select>
                  </div>
              </Col>
              <Col lg="6" md="12"> 
                  <div className='search__box'>
                    <input 
                      type="text" 
                      placeholder="Search......."
                      onChange={handleSearch} 
                    />
                    <span> <i class="ri-search-line"></i> </span>
                  </div>
              </Col>
            </Row>
          </Container>
        </section>
        <section className='pt-0'>
            <Container>
              <Row>
                  {
                    productsData.length === 0 ? (<h1 className='text-center fs-4'> No Products are Found! </h1>) 
                    : (<ProductsList data={productsData} />
                    )
                  }
              </Row>
            </Container>
        </section> */}
    </Helmet>
  )
};

export default Shop;