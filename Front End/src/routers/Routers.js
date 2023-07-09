import React from 'react';
import { Route, Navigate, Routes } from 'react-router-dom';
import Login from '../pages/Login';
import Signup from '../pages/Signup';
import Home from '../pages/Home';
import Shop from '../pages/Shop';
import ProductDetails from '../pages/ProductDetails';
import Cart from '../pages/Cart';
import Checkout from '../pages/Checkout';
// import { useParams } from 'react-router-dom';
import UserDashboard from '../pages/userDashboard/UserDashboard';
import WishList from '../pages/Wishlist';
import AllProductList from '../pages/AllproductList';
import AboutUs from '../pages/AboutUs';
import TermsCondition from '../pages/policy/TermsCondition';
import Refund from '../pages/policy/Refund';
import Shipping from '../pages/policy/Shipping';
import Privacy from '../pages/policy/Privacy';
import ContactUs from '../pages/ContactUs';
import Brands from '../components/Brands/Brands';
import AllCategoris from '../components/Categories/AllCategoris';
import Faq from '../pages/Faq';



const Routers = () => {
    return (
        <>
            <Routes>
                    <Route path   = '/' element={<Navigate to="home"/>}/>
                    <Route path   = 'home' element={<Home/>} />
                    <Route path   = 'product/list/:category_id/:subcategory_id/:type/:offer_id' element={<Shop/>} />
                    <Route path   = 'products/list/:category_id/:subcategory_id/:type/:offer/:brand_id' element={<AllProductList/>} />
                    <Route path   = 'product/wishlist' element={<WishList/>} />
                    <Route path   = 'shop/:id' element={<ProductDetails/>} />
                    <Route path   = 'cart' element={<Cart/>} />
                    <Route path   = 'checkout' element={<Checkout/>} />
                    <Route path   = 'all/product' element={<AllProductList/>} />
                    <Route path   = 'login' element={<Login/>} />
                    <Route path   = 'signup' element={<Signup/>} />
                    <Route path   = 'user/deshboard/:activ' element={<UserDashboard/>} />
                    <Route path   = 'aboutus/' element={<AboutUs/>} />
                    <Route path   = 'about/privacy/:privacy' element={<Privacy/>} />
                    <Route path   = 'about/shipping/:shipping' element={<Shipping/>} />
                    <Route path   = 'about/refund/:refund' element={<Refund/>} />
                    <Route path   = 'about/terms/condition/:termsCondition' element={<TermsCondition/>} />
                    <Route path   = 'contact/us/:contactUs' element={<ContactUs/>} />
                    <Route path   = 'all/brands' element={<Brands/>} />
                    <Route path   = 'all/category' element={<AllCategoris/>} />
                    <Route path   = 'faq/' element={<Faq/>} />
            </Routes>
        </>
     );
};

export default Routers;