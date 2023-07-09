import React, { useState, useEffect, memo } from 'react';
import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';

import "slick-carousel/slick/slick.css";

import "slick-carousel/slick/slick-theme.css";

import Helmet from '../components/Helmet/Helmet';
import '../styles/home.css';

import { Col, Container, Row } from 'reactstrap';
import { useSelector, useDispatch } from "react-redux"
import ProductsList from '../components/UI/ProductsList';
import Top10Card from '../components/UI/ToptenCard';
import HeroSlider from '../components/Element/Slider/HeroSlider';
import Categories from '../components/Categories/Categories';
import serviceData from '../assets/data/serviceData';
import ProductCard from '../components/UI/ProductCard';
import axiosClient from '../axios-client';
import { getCurrencydata, shippingCost } from '../redux/slices/settingSlice';
import GeneralProductList from '../components/UI/GeneralProductList';
import { useQuery } from 'react-query';
import CategoriesBanner from '../components/UI/CategoriesBanner';
import { Skeleton } from '@mui/material';
import addBanner from '../assets/images/home-v5-banner.png'
import catBanner1 from '../assets/images/cat-banner-1.jpg'
import catBanner2 from '../assets/images/cat-banner-2.jpg'
import catBanner3 from '../assets/images/cat-banner-3.jpg'



const Home = () => {

  const [trendingProducts, settrendingProducts] = useState([]);
  const [bestSalesProducts, setbestSalesProducts] = useState([]);
  const [popularProdutcs, setpopularProdutcs] = useState([]);
  const [newArrivalProduct, setnewArrivalProduct] = useState([]);
  const [isrender, setIsRender] = useState(true);
  const [offerBanner, setOfferBanner] = useState([]);
  const [category, setCategoryList] = useState([]);

  const year = new Date().getFullYear();
  const dispatch = useDispatch();

  const basepath = useSelector((state) => state.setting.basepath);
  const bannerlink = useQuery('bannerlink', async () => await axiosClient.get('featured/link/list').then(({ data }) => data));

  const offerBannerdata = useQuery('myDatas', async () => await axiosClient.get('offer/banner').then(({ data }) => data));
  const categoryListdata = useQuery('category', async () => await axiosClient.get('product/category').then(({ data }) => data));
  const trendingListdata = useQuery('trending', async () => await axiosClient.get('home/trending/product/get').then(({ data }) => data.data));
  const bestsellListdata = useQuery('bestsell', async () => await axiosClient.get('home/best/sell/product').then(({ data }) => data));
  const newarrivaldata = useQuery('newarrival', async () => await axiosClient.get('home/new/arrival/product').then(({ data }) => data));
  const populardata = useQuery('popular', async () => await axiosClient.get('home/popular/product/get').then(({ data }) => data));
  const popularcategory = useQuery('popularCategory', async () => await axiosClient.get('product/popular/category').then(({ data }) => data));
  const popularbrand = useQuery('popularBrand', async () => await axiosClient.get('product/top/brand').then(({ data }) => data));

  useQuery('currency', () => dispatch(getCurrencydata()));



  return (
    <Helmet title={"Home"}>

      {/* Hero area Section */}
      {/* {offerBanner.length>0&&<HeroSlider offerBanner={offerBanner} />} */}
      <section className="hero__area">
        <Container className='paddingsst'>
          <Row>
            <Col lg='3' md='4'>
              {categoryListdata.isLoading == false ? <Categories category={categoryListdata.data} /> : <div><Skeleton variant="rectangular" className='mt-3 loadcategory' /></div>}
            </Col>
            <Col lg='9' md='8'>
              {offerBannerdata.isLoading == false ? <HeroSlider offerBanner={offerBannerdata.data} /> : <div><Skeleton variant="rectangular" className='mt-3 loadslidertop' /></div>}

              {popularcategory.isLoading == false ? <CategoriesBanner categorydata={popularcategory.data} /> : <div><Skeleton variant="rectangular" className='mt-3 loadslidertop' /></div>}
            </Col>
          </Row>
        </Container>
      </section>

      {/* categories wise featureSection */}
      <section className='categories_feature'>
        <Container className='paddingsst'>
          <div className='cate_wise_feature'>
            {bannerlink.isLoading == false && bannerlink.data.map((banner_link, index) => {
              return <div className='cate_feature'>
             
                <a href={banner_link.link} target="_blank" style={{width: '100%'}}>
                  <img src={`${basepath}/${banner_link.image}`} className='img-fluid' alt="counterImg" />
                </a>
              </div>
            })}
          </div>
        </Container>
      </section>

      {/* Trending Products Section */}
      <section className='trending__products'>
        <Container>
          <Row className='productlistCard' >
            <Col lg='12' md='12' sm='12' >
              <div className='d-flex justify-content-between p-2 mb-2 pb-2 btmborder__st'>
                <div className="section__title">
                  <h3> Trending Products </h3>
                </div>
                <div className="section_product">
                  {/* <Link to='/product/list/none/none/trending/0' > View More </Link> */}
                  <Link to={`/products/list/0/0/trending/0/0`} > View More </Link>

                </div>
              </div>
            </Col>
            <Col lg='12' md='12' sm='12'>
              {trendingListdata.isLoading == false && <ProductsList data={trendingListdata.data} />}

            </Col>
          </Row>
        </Container>
      </section>

      {/* Best Sales Products Section */}
      <section className='best__sales'>
        <Container>
          <Row className='productlistCard' >
            <Col lg='12' md="12" >
              <div className='d-flex justify-content-between p-2 mb-2 pb-2 btmborder__st'>
                <div className="section__title">
                  <h3> Best Sales</h3>
                </div>
                <div className="section_product">
                  {/* <Link to='/product/list/none/none/bestSell/0' > View More </Link> */}
                  <Link to={`/products/list/0/0/bestSell/0/0`} > View More </Link>
                </div>
              </div>
            </Col>
            <Col lg='12' md="12" sm="12">
              {/* <ProductsList
                        data={bestSalesProducts}
                    />  */}
              {
                bestsellListdata.isLoading == false &&
                <GeneralProductList data={bestsellListdata.data} />
              }
            </Col>
          </Row>
        </Container>
      </section>

      {/* Add Banner Section */}
      <section className='add__banner'>
        <Container className='paddingsst'>
          <Row className='align-items-center'>
            <Col lg='12' md='12'>
              <div className='addbanner_card'>
                <img src={addBanner} className='img-fluid' alt="counterImg" />
              </div>
            </Col>
          </Row>
        </Container>
      </section>

      {/* New Arrivals Section */}
      <section className='new__arrivals'>
        <Container>
          <Row className='productlistCard'>
            <Col lg='12'>
              <div className='d-flex justify-content-between p-2 mb-2 pb-2 btmborder__st'>
                <div className="section__title">
                  <h3> New Arrivals</h3>
                </div>
                <div className="section_product">
                  {/* <Link to='/product/list/none/none/newArrival/0' > View More </Link> */}
                  <Link to={`/products/list/0/0/newArrival/0/0`} > View More </Link>
                </div>
              </div>
            </Col>
            <Col lg='12'>
              {/* <ProductsList data={newArrivalProduct}/> 
                  <ProductsList data={newArrivalProduct} /> */}

              {newarrivaldata.isLoading == false && <GeneralProductList data={newarrivaldata.data} />}
            </Col>
          </Row>
        </Container>
      </section>

      {/* Add Banner Section */}
      <section className='add__banner'>
        <Container className='paddingsst'>
          <Row className='align-items-center'>
            <Col lg='12' md='12'>
              <div className='addbanner_card'>
                <img src={addBanner} className='img-fluid' alt="counterImg" />
              </div>
            </Col>
          </Row>
        </Container>
      </section>

      {/* Popular Product Section */}
      <section className='popular_product'>
        <Container>
          <Row className='productlistCard'>
            <Col lg='12'>
              <div className='d-flex justify-content-between p-2 mb-2 pb-2 btmborder__st'>
                <div className="section__title">
                  <h3> Popular Product </h3>
                </div>
                <div className="section_product">
                  {/* <Link to='/product/list/none/none/popular/0' > View More </Link> */}
                  <Link to={`/products/list/0/0/popular/0/0`} > View More </Link>
                </div>
              </div>
            </Col>
            <Col lg='12'>
              {populardata.isLoading == false && <ProductsList data={populardata.data} />}
            </Col>
          </Row>
        </Container>
      </section>

      {/* Top 10 Categories/Brands Section */}
      <section className='top_10_area mb-4'>
        <Container className='paddingsst'>
          <Row className='py-3'>
            <Col lg='6' md='12'>
              <div className='d-flex justify-content-between p-2 mb-2 pb-2 btmborder__st'>
                <div className="section__title">
                  <h3> Top 10 Categories </h3>
                </div>
                <div className="section_product">
                  <Link to='/all/category' > View All Categories </Link>
                </div>
              </div>
              <div className='row'>
              {popularcategory.isLoading == false && popularcategory.data.map((data,index)=>{
                return <div className='col-lg-6 col-md-6'>
                  <Link to={`/products/list/${data.id}/0/popular/0/0`} className='w-100' ><Top10Card image={`${basepath}/${data.image}`} name={`${data.name}`} type="category" category_id={data.id} /></Link>
                       </div>
              }) }

                
                {/* <div className='col-lg-6 col-md-6'>
                  <Top10Card />
                </div> */}
              </div>
            </Col>
            <Col lg='6' md='12'>
              <div className='d-flex justify-content-between p-2 mb-2 pb-2 btmborder__st'>
                <div className="section__title">
                  <h3> Top 10 Brands </h3>
                </div>
                <div className="section_product">
                  <Link to="/all/brands"> View All Brands </Link>
                </div>
              </div>
              <div className="row">
              {popularbrand.isLoading == false && popularbrand.data.map((data,index)=>{
                return <div className='col-lg-6 col-md-6'>
                          <Top10Card image={`${basepath}/${data.image}`} name={`${data.name}`} type="category" brand_id={data.id} />
                       </div>
              }) }
              </div>
            </Col>
          </Row>
        </Container>
      </section>

    </Helmet>
  )
}

export default Home;