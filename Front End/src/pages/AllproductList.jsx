import React, { useEffect, useState } from 'react'
import Helmet from '../components/Helmet/Helmet'
import { Accordion, AccordionBody, AccordionHeader, AccordionItem, Form, FormGroup, Input, Label } from 'reactstrap';
import CommonSection from '../components/UI/CommonSection'
import '../styles/shop.css';
import { Col, Container, Row } from 'reactstrap';
import axiosClient from '../axios-client';
import ProductSection from '../components/UI/ProductSection';
import { UncontrolledCollapse } from 'reactstrap';
import "../styles/allproduct.css";
import Box from '@mui/material/Box';
import Slider from '@mui/material/Slider';
import { useParams } from 'react-router-dom';
import { BiReset } from "react-icons/bi";
import { useQuery } from 'react-query';


const AllProductList = () => {
    const{category_id,subcategory_id,type,offer}=useParams()
    const categoryPrm=category_id==undefined?0:category_id;
    const subCategoryPrm=category_id==undefined?0:subcategory_id;
    const typeprm=type==undefined?0:type;
//     trending
// bestSell
// newArrival
// popular

    const [productlist, setProductList] = useState([]);
    const [categorySubcategory, setcategorySubcategory] = useState([]);
    const [sizelist, setSizeList] = useState([]);
    const [colorlist, setColorList] = useState([]);
    const [category, setcategory] = useState(categoryPrm);
    const [subcategory, setsubcategory] = useState(subCategoryPrm);
    const [typey, settype] = useState(typeprm);
    const [selectColor, setselectColor] = useState('0');
    const [selectSiz, setselectedSiz] = useState('0');
    const [srcarr, setsrcarr] = useState({});
    const [path, setpath] = useState(window.location.pathname);

    // const categorySubcategory = useQuery('categoryData', async () => await axiosClient.get('/all/category/subcategory').then(({ data }) => data));

    // console.log(categorySubcategory)

    const subcategorylist = useQuery('subcategory', async () => await axiosClient.get('all/category/subcategory').then(({ data }) => data));

    console.log(subcategorylist.isSuccess);

    useEffect(() => {
        axiosClient
            .get('all/category/subcategory')
            .then(({ data }) => {
                setcategorySubcategory(data);
            });

        axiosClient
            .get('product/size/list')
            .then(({ data }) => {
                var allSizlist = [];
                data.map(sizelist => {
                    let sizeTxt = sizelist.size;
                    let sizearr = sizeTxt.toUpperCase().split(',');
                    allSizlist = [...allSizlist, ...sizearr];
                })
                allSizlist = [...new Set(allSizlist)];
                setSizeList(allSizlist);
            });

        axiosClient
            .get('product/color/list')
            .then(({ data }) => {
                var allColorlist = [];
                data.map(colorlist => {
                    let colorTxt = colorlist.color;
                    let colorarr = colorTxt.split(',');
                    allColorlist = [...allColorlist, ...colorarr];
                })
                allColorlist = [...new Set(allColorlist)];
                setColorList(allColorlist);


            });


    }, [path,selectSiz])

    useEffect(()=>{

    },[productlist])




    function valuetext(value) {
        return `${value}°C`;
    }

    const minDistance = 10;


    const [value1, setValue1] = React.useState([0, 40000]);

    const handleChange1 = (
        event,
        newValue,
        activeThumb,
    ) => {
        if (!Array.isArray(newValue)) {
            return;
        }

        if (activeThumb === 0) {
            setValue1([Math.min(newValue[0], value1[1] - minDistance), value1[1]]);
        } else {
            setValue1([value1[0], Math.max(newValue[1], value1[0] + minDistance)]);
        }

    };

    const categoryProduct = (category_id) => {
        setcategory(category_id);
        setsubcategory(0);
    }

    const reset=()=>{
        setselectedSiz(0)
        setselectColor(0)
        let srcdatalist = {
            min: value1[0],
            max: value1[1],
            category_id: category,
            sub_category_id: subcategory,
            color: 0,
            size: 0,
            type:typey,
        }
        axiosClient
            .post("product/price/range/src",srcdatalist)
            .then(({ data }) => {
                setProductList(data);
            });

    }

    const subCategoryProduct = (subCategory_id) => {
        setsubcategory(subCategory_id)
    }
    useEffect(() => {
        getrangewiseproduct()
    }, [selectColor, selectSiz, category, subcategory])

    useEffect(() => {
        let srcproduct = setTimeout(() => {
            getrangewiseproduct();

        }, 500);
        return () => clearTimeout(srcproduct)
    }, [value1])

    const getrangewiseproduct = () => {
        let srcdatalist = {
            min: value1[0],
            max: value1[1],
            category_id: category,
            sub_category_id: subcategory,
            color: selectColor,
            size: selectSiz,
            type:typey,
        }
        axiosClient
            .post("product/price/range/src", srcdatalist)
            .then(({ data }) => {
                setProductList(data);
            });
    }

    return (
        <Helmet title='Shop'>
            {/* <CommonSection title={'Products'}/> */}
            <Container>
                <Row>
                    <Col lg="3" md="3">
                        <div className="main-products-wrapper">
                            <div className='main-products'>
                                <section className='new__arrivals'>
                                    <Container>
                                        <Row className=''>
                                            <Col lg='12' className='srcdiv'>
                                                <div>
                                                    <h4 className='sideitemtxt'>Category  <span onClick={reset} className='reseticon'><BiReset/></span></h4>
                                                </div>
                                                <ul>
                                                    {                                                   
                                                        subcategorylist.isSuccess&&subcategorylist.data.map(cate => {
                                                            return <>
                                                                <li>
                                                                    <button className='category_name' id={`cate${cate.id}`} onClick={() => categoryProduct(cate.id)}>{cate.name}</button>
                                                                </li>
                                                                <UncontrolledCollapse toggler={`#cate${cate.id}`} className={cate.id==category&&'show'}>
                                                                    {
                                                                        cate.subcategory.map(sub => {
                                                                            return <li className="sub_category_name "  onClick={() => subCategoryProduct(sub.id)}>-<span className='testbd'>{sub.name}</span> </li>
                                                                        })
                                                                    }
                                                                </UncontrolledCollapse>
                                                            </>
                                                        })
                                                    }
                                                </ul>
                                            </Col>
                                            <Col lg='12' className='srcdiv'>
                                                <h4 className='sideitemtxt'>Price Range</h4>
                                                <Slider
                                                    min={0}   // Minimum value
                                                    max={70000} // Maximum value
                                                    step={50}  // Incremental step
                                                    getAriaLabel={() => 'Minimum distance'}
                                                    value={value1}
                                                    onChange={handleChange1}
                                                    valueLabelDisplay="auto"
                                                    getAriaValueText={valuetext}
                                                    disableSwap
                                                />
                                                <div className='pricerangeset'>
                                                    <span>Min: {value1[0]}</span>
                                                    <span>Max: {value1[1]}</span>

                                                </div>
                                            </Col>

                                            <Col className='srcdiv'>
                                                <h4 className='sideitemtxt'>Size</h4>
                                                <div className='colorsizheight'>
                                                    {
                                                        sizelist.map(siz => {
                                                            return <>
                                                                < FormGroup check key={siz}>
                                                                    <Input
                                                                        name="siz"
                                                                        type="radio"
                                                                        onClick={event => setselectedSiz(siz)}
                                                                        checked={siz==selectSiz?true:false}
                                                        
                                                                    />
                                                                    <Label check className='category_name'>
                                                                        {siz}
                                                                    </Label>
                                                                </FormGroup></>
                                                        })
                                                    }
                                                </div>
                                            </Col>
                                            <Col lg='12' sm="12" className='srcdiv'>
                                                <h4 className='sideitemtxt'>Color</h4>
                                                <div className='colorsizheight'>
                                                    {
                                                        colorlist.map(color => {
                                                            return <>
                                                                < FormGroup check>
                                                                    <Input
                                                                        name="color"
                                                                        type="radio"
                                                                        onClick={() => setselectColor(color)}
                                                               
                                                                        checked={color==selectColor?true:false}
                                                                    />
                                                                    <Label check>
                                                                        <div className='colorcodeset' style={{ background: color }}></div>
                                                                    </Label>
                                                                </FormGroup></>
                                                        })
                                                    }

                                                </div>
                                            </Col>
                                        </Row>
                                    </Container>
                                </section>
                            </div>
                        </div>
                    </Col>

                    <Col lg="9" md="9">
                        <Row className='product_sort_Card '>
                            <Col lg='2' md='6'>
                                <div className="shop__title">
                                    <h3>All Product</h3>
                                </div>
                            </Col>
                            <Col lg='3' md='6'>
                                <div className='asds_by'>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected> A to Z  </option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option>Name (A - Z)</option>
                                        <option>Name (Z - A)</option>
                                        <option>Price (Low to High)</option>
                                        <option>Price (High to Low)</option>
                                        <option>Rating (Highest)</option>
                                        <option>Rating (Lowest)</option>
                                        <option>Model (A - Z)</option>
                                        <option>Model (Z - A)</option>
                                        <option>Out Of Stock</option>
                                        <option>In Stock</option>
                                    </select>
                                </div>
                            </Col>
                            <Col lg='3' md='4'>
                                <div className='sort_by'>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected> Sort by </option>
                                        <option value="1"> Newest </option>
                                        <option value="1"> Oldest </option>
                                        <option value="2">Pricce low to high </option>
                                        <option value="3">Price high to low </option>
                                    </select>
                                </div>
                            </Col>
                            <Col lg='2' md='4'>
                                <div className='brands_by'>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>All Brands </option>
                                        <option value="1"> Hp </option>
                                        <option value="2">Samsung </option>
                                        <option value="3">Asus </option>
                                    </select>
                                </div>
                            </Col>
                            <Col lg='2' md='4'>
                                <div className='brands_by'>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected> Show 20 </option>
                                        <option value="1">Show 30  </option>
                                        <option value="2">Show all</option>
                                    </select>
                                </div>
                            </Col>
                        </Row>
                        <Row className='all_product_Card'>
                            <Col lg='12' md='12'>
                                <ProductSection data={productlist} />
                            </Col>
                        </Row>
                        
                        <Row className='product_pagination_Card'>
                            <div className="col-md-12">
                                <nav aria-label="Page navigation example">
                                    <ul className="pagination float-end">
                                        <li className="page-item"><a className="page-link" href="#">Previous</a></li>
                                        <li className="page-item"><a className="page-link" href="#">1</a></li>
                                        <li className="page-item"><a className="page-link" href="#">2</a></li>
                                        <li className="page-item"><a className="page-link" href="#">3</a></li>
                                        <li className="page-item"><a className="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </Row>
                        
                    </Col>
                </Row>
               
            </Container>
        </Helmet >
    )
};

export default AllProductList;