import React from 'react';
import './ProductCard2.css';
import ReactStars from "react-rating-stars-component";
import { Col } from 'reactstrap';
import { Link } from 'react-router-dom';

function ProductCard2() {
  return (
    <Col lg='3' md='3'>
        <div className="product-card position-relative">
            <div className='wishlist-icon position-absolute'>
                <Link to=''>
                    <img src="header-img/wish.svg" alt="wishlist" />
                </Link>
            </div>
            <div className="product-image">
                <img src="header-img/watch.jpg" className='img-fluid'  alt=" product image " />
                <img src="header-img/tv.jpg"  className='img-fluid' alt=" product image " />
            </div>
            <div className="product-details">
                <h6 className='brand mb-2'> Havels </h6>
                <h5 className='product-title'> kids Headphones bulk 10 pack multi colored for students </h5>
                <ReactStars count={5} size={24} value="3" activeColor="#ffd700" edit={false} />
                <p className='product-price'> $100.00 </p>
                <div className="position-absolute"></div>
            </div>
            <div className='action-bar position-absolute'>
                <div className=' d-flex flex-column gap-15'>

                    <Link to=''>
                        <img src="header-img/prodcompare.svg" alt="addcart" />
                    </Link>
                    <Link to=''>
                        <img src="header-img/view.svg" alt="addcart" />
                    </Link>
                    <Link to=''>
                        <img src="header-img/add-cart.svg" alt="addcart" />
                    </Link>

                </div>
            </div>
        </div>
    </Col>
  )
}

export default ProductCard2;