import React, { useRef, useState } from "react";
import Helmet from "../../components/Helmet/Helmet";
import { Link } from "react-router-dom";
import {
    Col,
    Container,
    Form,
    FormGroup,
    Input,
    Label,
    Row,
    Button,
} from "reactstrap";

import { useEffect } from "react";
import axiosClient from "../../axios-client";
import { toast } from "react-toastify";

const UserAddress = () => {
    const [emailShippingRef, setemailShippingRef] = useState('');
    const [first_nameShippingRef, setfirst_nameShippingRef] = useState('');
    const [last_nameShippingRef, setlast_nameShippingRef] = useState('');
    const [addressShippingRef, setaddressShippingRef] = useState('');
    const [countryShippingRef, setcountryShippingRef] = useState('');
    const [cityShippingRef, setcityShippingRef] = useState('');

    const [divisionShippingRef, setDivisionShippingRef] = useState('');
    const [districtShippingRef, setDistrictShippingRef] = useState('');

    const [stateShippingRef, setstateShippingRef] = useState('');
    const [zipShippingRef, setzipShippingRef] = useState('');
    const [addressBillingRef, setaddressBillingRef] = useState('');
    const [countryBillingRef, setcountryBillingRef] = useState('');
    const [cityBillingRef, setcityBillingRef] = useState('');
    const [stateBillingRef, setstateBillingRef] = useState('');

    const [divisionBillingRef, setdivisionBillingRef] = useState('');
    const [districtBillingRef, setdistrictBillingRef] = useState('');

    const [zipBillingRef, setzipBillingRef] = useState('');
    const [shippingPhone, setshippingPhone] = useState('');

    const [billingPhone, setbillingPhone] = useState('');
    const [firstnameBillingRef, setfirstnameBillingRef] = useState('');
    const [lastnameBillingRef, setlastnameBillingRef] = useState('');
    const [emailBillingingRef, setemailBillingRef] = useState('');

    const [countryList, setCountryList] = useState([]);
    const [divisionList, setdivisionList] = useState([]);
    const [districtList, setdistrictList] = useState([]);
    const [billingDistrictList, setBillingdistrictList] = useState([]);
    const [userAddressData, setUserAddressData] = useState([]);

    useEffect(() => {
        axiosClient.get("country/list").then(({ data }) => {
            setCountryList(data)
        });
        axiosClient.get("division/list").then(({ data }) => {
            console.log(data)
            setdivisionList(data)
        });



        axiosClient.get("user/shipping/billing/address/get").then(({ data }) => {
            if(data.data){
            setUserAddressData(data.data);
            setemailShippingRef(data.data.email);
            setfirst_nameShippingRef(data.data.first_name);
            setlast_nameShippingRef(data.data.last_name);
            setaddressShippingRef(data.data.shipping_address);
            setcountryShippingRef(data.data.shipping_country);
            setcityShippingRef(data.data.shipping_city);
            setstateShippingRef(data.data.shipping_state);

            setDivisionShippingRef(data.data.shipping_division);
            setDistrictShippingRef(data.data.shipping_district);

            setzipShippingRef(data.data.shipping_zip);
            setaddressBillingRef(data.data.billing_address);
            setcountryBillingRef(data.data.billing_country);
            setcityBillingRef(data.data.billing_city);
            setstateBillingRef(data.data.billing_state);
            setzipBillingRef(data.data.billing_zip);
            setshippingPhone(data.data.shipping_phone);
            setbillingPhone(data.data.billing_phone);
            setfirstnameBillingRef(data.data.billing_first_name);
            setlastnameBillingRef(data.data.billing_last_name);
            setemailBillingRef(data.data.billing_email);

            setdivisionBillingRef(data.data.billing_division);
            setdistrictBillingRef(data.data.billing_district);


            if(data.data.shipping_division){
                getDistrictList(data.data.shipping_division)
            }

            if(data.data.billing_division){
                getBillingDistrictList(data.data.billing_division)
            }
        }

        });

    }, [])


    const saveAddress = (event) => {
        event.preventDefault();
        const shippingInfo = {
            shipping_email: emailShippingRef,
            shipping_first_name: first_nameShippingRef,
            shipping_last_name: last_nameShippingRef,
            shipping_address: addressShippingRef,
            shipping_country: countryShippingRef,
            shipping_city: cityShippingRef,
            shipping_state: stateShippingRef,
            shipping_zip: zipShippingRef,

            shipping_division: divisionShippingRef,
            shipping_district: districtShippingRef,
            billing_division: divisionBillingRef,
            billing_district: districtBillingRef,

            billing_address: addressBillingRef,
            billing_country: countryBillingRef,
            billing_city: cityBillingRef,
            billing_state: stateBillingRef,
            billing_zip: zipBillingRef,
            billing_first_name: firstnameBillingRef,
            billing_last_name: lastnameBillingRef,
            shipping_phone: shippingPhone,
            billing_phone: billingPhone,
            billing_email: emailBillingingRef
      
        
        };


        axiosClient
            .post('user/shipping/billing/address', shippingInfo)
            .then(({ data }) => {
                console.log(data)
                if (data.status == 200) {
                    toast.success(data.msg)
                }
            });
    }

    let getDistrictList = (divisionId) => {
        axiosClient.get(`district/list?divisionId=${divisionId}`).then(({ data }) => {
            setdistrictList(data)
        });
        setDivisionShippingRef(divisionId)
    }

    let getBillingDistrictList = (divisionId) => {
        axiosClient.get(`district/list?divisionId=${divisionId}`).then(({ data }) => {

            setBillingdistrictList(data)
        });
        setdivisionBillingRef(divisionId)
    }

    return (
        <Helmet title="Login">
            <section>
                <Container>
                    <form onSubmit={saveAddress}>
                        <Row className="dashboardCard">
                            <Col lg="12" className="addressPd"  >
                                <strong className="text-center">Shipping Address</strong>
                                <hr />
                                <div>
                                    <Form>
                                        <Row>
                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="exampleEmail"
                                                    >
                                                        First Name
                                                    </Label>
                                                    <Input
                                                        id="firstName"
                                                        className="form-control"
                                                        value={first_nameShippingRef}
                                                        onChange={(data) => { setfirst_nameShippingRef(data.target.value) }}
                                                        name="first_name"
                                                        placeholder="First Name"
                                                        type="email"
                                                    />
                                                </FormGroup>
                                            </Col>
                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="exampleEmail"

                                                    >
                                                        Last Name
                                                    </Label>
                                                    <Input
                                                        id="exampleEmail"
                                                        value={last_nameShippingRef}
                                                        onChange={(data) => { setlast_nameShippingRef(data.target.value) }}
                                                        name="last_name"
                                                        placeholder="Last Name"
                                                        type="text"
                                                    />
                                                </FormGroup>
                                            </Col>
                                        </Row>



                                        <Row>
                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="exampleEmail"

                                                    >
                                                        Email
                                                    </Label>
                                                    <Input
                                                        id="exampleEmail"
                                                        value={emailShippingRef}
                                                        onChange={(data) => { setemailShippingRef(data.target.value) }}
                                                        name="email"
                                                        placeholder="Email"
                                                        type="email"
                                                        required
                                                    />
                                                </FormGroup>
                                            </Col>
                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="exampleEmail"

                                                    >
                                                        Phone
                                                    </Label>
                                                    <Input
                                                        id="exampleEmail"
                                                        value={shippingPhone}
                                                        onChange={(data) => { setshippingPhone(data.target.value) }}
                                                        name="last_name"
                                                        placeholder="Last Name"
                                                        type="text"
                                                    />
                                                </FormGroup>
                                            </Col>
                                        </Row>

                                        <FormGroup>
                                            <Label
                                                for="shippingaddress"

                                            >
                                                Address
                                            </Label>
                                            <Input
                                                id="exampleEmail"
                                                name="address"
                                                value={addressShippingRef}
                                                onChange={(data) => { setaddressShippingRef(data.target.value) }}

                                                placeholder="Address"
                                                type="email"
                                            />
                                        </FormGroup>


                                        <Row>
                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="shippingcountry"

                                                    >
                                                        Country
                                                    </Label>

                                                    <Input type="select" name="select" id="exampleSelect" value={countryShippingRef} onChange={(data) => { setcountryShippingRef(data.target.value) }} placeholder="Country">
                                                        {
                                                            Object.keys(countryList).map((data, index) => {
                                                                return <option value={countryList[data].name}>{countryList[data].name}</option>
                                                            })
                                                        }

                                                    </Input>

                                                </FormGroup>
                                            </Col>

                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="shippingcountry"

                                                    >
                                                        Division
                                                    </Label>

                                                    <Input type="select" name="division" id="exampleSelect" value={divisionShippingRef} onChange={(data) => { getDistrictList(data.target.value) }} placeholder="Division">
                                                        {

                                                            divisionList.map((data, index) => {
                                                                return <option value={data.id}>{data.name}</option>
                                                            })
                                                        }

                                                    </Input>

                                                </FormGroup>
                                            </Col>

                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="shippingdistrict"

                                                    >
                                                        District
                                                    </Label>


                                                    <Input type="select" name="division" id="exampleSelect" value={districtShippingRef} onChange={(data) => { setDistrictShippingRef(data.target.value) }} placeholder="Country">
                                                        {
                                                            districtList.map((data, index) => {
                                                                return <option value={data.id}>{data.name}</option>
                                                            })
                                                        }

                                                    </Input>

                                                </FormGroup>
                                            </Col>
                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="exampleEmail"

                                                    >
                                                        Postal Code
                                                    </Label>
                                                    <Input
                                                        id="exampleEmail"
                                                        name="zip"
                                                        value={zipShippingRef}
                                                        onChange={(data) => { setzipShippingRef(data.target.value) }}
                                                        placeholder="Zip"
                                                        type="text"
                                                    />
                                                </FormGroup>
                                            </Col>
                                            {/* <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="shippingcity"
                                                        
                                                    >
                                                        City
                                                    </Label>
                                                    <Input
                                                        id="exampleEmail"
                                                        value={cityShippingRef}
                                                        name="city"
                                                        onChange={(data) => {setcityShippingRef(data.target.value) }} 
                                                        placeholder="City"
                                                        type="text"
                                                    />
                                                </FormGroup>
                                            </Col> */}
                                        </Row>
                                        <Row>
                                            {/* <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="shippingstate"
                                                        
                                                    >
                                                        State
                                                    </Label>
                                                    <Input
                                                        id="exampleEmail"
                                                        value={stateShippingRef}
                                                        onChange={(data) => {setstateShippingRef(data.target.value) }} 
                                                        name="state"
                                                        placeholder="State"
                                                        type="text"
                                                    />
                                                </FormGroup>
                                            </Col> */}

                                        </Row>
                                    </Form>

                                </div>

                            </Col>
                            <Col lg="12" className="addressPd"  >
                                <strong className="text-center">Billing Address</strong>
                                <hr />
                                <div>


                                    <Form>
                                        <Row>
                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="exampleEmail"
                                                    >
                                                        First Name
                                                    </Label>
                                                    <Input
                                                        id="firstName"
                                                        value={firstnameBillingRef}
                                                        onChange={(data) => { setfirstnameBillingRef(data.target.value) }}
                                                        name="first_name"
                                                        placeholder="First Name"
                                                        type="email"
                                                    />
                                                </FormGroup>
                                            </Col>
                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="exampleEmail"

                                                    >
                                                        Last Name
                                                    </Label>
                                                    <Input
                                                        id="exampleEmail"
                                                        value={lastnameBillingRef}
                                                        onChange={(data) => { setlastnameBillingRef(data.target.value) }}
                                                        name="last_name"
                                                        placeholder="Last Name"
                                                        type="text"
                                                    />
                                                </FormGroup>
                                            </Col>
                                        </Row>


                                        <Row>
                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="exampleEmail"

                                                    >

                                                        Phone
                                                    </Label>
                                                    <Input
                                                        id="firstName"
                                                        value={billingPhone}
                                                        onChange={(data) => { setbillingPhone(data.target.value) }}
                                                        name="first_name"
                                                        placeholder="Phone"
                                                        type="string"
                                                    />
                                                </FormGroup>
                                            </Col>
                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="exampleEmail"

                                                    >
                                                        Email
                                                    </Label>
                                                    <Input
                                                        id="exampleEmail"
                                                        value={emailBillingingRef}
                                                        onChange={(data) => { setemailBillingRef(data.target.value) }}
                                                        name="billing_email"
                                                        placeholder="billing email"
                                                        type="text"
                                                    />
                                                </FormGroup>
                                            </Col>
                                        </Row>
                                        <FormGroup>
                                            <Label
                                                for="billingaddress"

                                            >
                                                Address
                                            </Label>
                                            <Input
                                                value={addressBillingRef}
                                                onChange={(data) => { setaddressBillingRef(data.target.value) }}
                                                id="exampleEmail"
                                                name="email"
                                                placeholder="Address"
                                                type="text"
                                            />
                                        </FormGroup>

                                        <Row>
                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="billingCountry"
                                                    >
                                                        Country
                                                    </Label>
                                                    <Input type="select" name="select" id="exampleSelect" value={countryBillingRef} onChange={(data) => { setcountryBillingRef(data.target.value) }} placeholder="Country">
                                                        {
                                                            Object.keys(countryList).map((data, index) => {
                                                                return <option>{countryList[data].name}</option>
                                                            })
                                                        }
                                                    </Input>
                                                </FormGroup>
                                            </Col>

                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="shippingcountry"

                                                    >
                                                        Division
                                                    </Label>

                                                    <Input type="select" name="division" id="exampleSelect" value={divisionBillingRef} onChange={(data) => { getBillingDistrictList(data.target.value) }} placeholder="Division">
                                                        {

                                                            divisionList.map((data, index) => {
                                                                return <option value={data.id}>{data.name}</option>
                                                            })
                                                        }

                                                    </Input>

                                                </FormGroup>
                                            </Col>

                                            <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="shippingdistrict" >
                                                        District2
                                                    </Label>


                                                    <Input type="select" name="division" id="exampleSelect" value={districtBillingRef} onChange={(data) => { setdistrictBillingRef(data.target.value) }} placeholder="District">
                                                        {
                                                            billingDistrictList.map((data, index) => {
                                                                let selerc=""
                                                                if(districtBillingRef==data.id){
                                                                    selerc="selected";
                                                                }
                                                                return <option value={data.id} selerc >{data.name}</option>
                                                            })
                                                        }

                                                    </Input>

                                                </FormGroup>
                                            </Col>
                                            <Col lg="6">
                                                <FormGroup>
                                                    <Label
                                                        for="billingpostal"
                                                    >
                                                        Postal Code
                                                    </Label>
                                                    <Input
                                                        value={zipBillingRef} onChange={(data) => { setzipBillingRef(data.target.value) }}
                                                        id="exampleEmail"
                                                        name="zip"
                                                        placeholder="Zip"
                                                        innerRef={zipBillingRef}
                                                        type="text"
                                                    />
                                                </FormGroup>
                                            </Col>



                                            {/* <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="billingcity"
                                                        
                                                    >
                                                        City
                                                    </Label>
                                                    <Input

                                                        id="exampleEmail"
                                                        name="city"
                                                        placeholder="City"
                                                        
                                                        value={cityBillingRef} onChange={(data) => {setcityBillingRef(data.target.value) }} 
                                                        
                                                        type="text"
                                                    />
                                                </FormGroup>
                                            </Col> */}
                                        </Row>
                                        <Row>
                                            {/* <Col lg="6" >
                                                <FormGroup>
                                                    <Label
                                                        for="billingstate"
                                                        
                                                    >
                                                        State
                                                    </Label>
                                                    <Input
                                                    setstateBillingRef
                                                    setzipBillingRef
                                                       value={stateBillingRef} onChange={(data) => {setstateBillingRef(data.target.value) }} 
                                                        
                                                        id="exampleEmail"
                                                        name="state"
                                                        placeholder="State"
                                                        type="text"
                                                    />
                                                </FormGroup>
                                            </Col> */}

                                        </Row>

                                    </Form>

                                </div>
                                <div className="d-flex float-right">
                                    <Button style={{ width: "100%" }} type="submit" > Save</Button></div>

                            </Col>



                        </Row>
                    </form>
                </Container>

            </section>
        </Helmet>
    );
};

export default UserAddress;
