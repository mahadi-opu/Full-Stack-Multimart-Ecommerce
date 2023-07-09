import React, { useEffect, useState } from "react";
import { Col, Container, Form, FormGroup, Row, Input } from "reactstrap";

import { AiOutlineRight } from "react-icons/ai";
import { useSelector, useDispatch } from "react-redux";
import { shippingCost,getCurrencydata } from "../../redux/slices/settingSlice";
import axiosClient from "../../axios-client";



const OrderShippingAddress = (props) => {

    const [emailShippingRef, setemailShippingRef] = useState('');
    const [first_nameShippingRef, setfirst_nameShippingRef] = useState('');
    const [last_nameShippingRef, setlast_nameShippingRef] = useState('');
    const [addressShippingRef, setaddressShippingRef] = useState('');
    const [countryShippingRef, setcountryShippingRef] = useState('');
    const [cityShippingRef, setcityShippingRef] = useState('');
    const [stateShippingRef, setstateShippingRef] = useState('');
    const [zipShippingRef, setzipShippingRef] = useState('');
    const [addressBillingRef, setaddressBillingRef] = useState('');
    const [countryBillingRef, setcountryBillingRef] = useState('');
    const [cityBillingRef, setcityBillingRef] = useState('');
    const [stateBillingRef, setstateBillingRef] = useState('');
    const [zipBillingRef, setzipBillingRef] = useState('');
    const [shippingPhone, setshippingPhone] = useState('');
  
    const [billingPhone, setbillingPhone] = useState('');
    const [firstnameBillingRef, setfirstnameBillingRef] = useState('');
    const [lastnameBillingRef, setlastnameBillingRef] = useState('');
    const [emailBillingingRef, setemailBillingRef] = useState('');
  
    const [countryList, setCountryList] = useState([]);
    const [userAddressData, setUserAddressData] = useState([]);
  
  
    const [districtList, setdistrictList] = useState([]);
    const [divisionShippingRef, setDivisionShippingRef] = useState('');
    const [divisionList, setdivisionList] = useState([]);
  
    const [districtShippingRef, setDistrictShippingRef] = useState('');
  
    const dispatch = useDispatch();
  
  
  
    const userInfodata = {
      name: "",
      email: "",
      phone: "",
      address: "",
      city: "",
      postal_code: "",
      country: "",
      division: "",
      district: "",
    };
  
    const [userInfo, setUserInfo] = useState(userInfodata);
  
  
    useEffect(() => {

      // axiosClient.get("user/shipping/billing/address/get").then(({ data }) => {
      //   dispatch(shippingCost({ divisionId: data.data.shipping_division, districtId: data.data.shipping_district}))
      // });
  
      axiosClient.get("division/list").then(({ data }) => {
        setdivisionList(data)
      });
  
  
      axiosClient.get("country/list").then(({ data }) => {
        setCountryList(data)
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
        if (data.data.shipping_division) getDistrictList(data.data.shipping_division)
        if (data.data.shipping_district) setDistrictShippingRef(data.data.shipping_district)
  
        setUserInfo({
          name: `${data.data.first_name} ${data.data.last_name}`,
          email: `${data.data.email}`,
          phone: `${data.data.shipping_phone}`,
          address: `${data.data.shipping_address}`,
          city: `${data.data.shipping_city}`,
          postal_code: `${data.data.shipping_zip}`,
          country: `${data.data.billing_country}`,
          division: `${data.data.shipping_division == null ? 0 : data.data.shipping_division}`,
          district: `${data.data.shipping_district == null ? 0 : data.data.shipping_district}`,
        })

        dispatch(shippingCost({ divisionId: userInfo.division, districtId: setUserInfo.district}))
      }
      });
  
      
      
  
    }, [])
  
  
    let getDistrictList = (divisionId) => {
      axiosClient.get(`district/list?divisionId=${divisionId}`).then(({ data }) => {
        setdistrictList(data)
      });
      setDivisionShippingRef(divisionId)
    }
  
    let onchangeDivision = (event) => {
      getDistrictList(event.target.value)
      inputdata(event)
    }
    let onChangeDistrict = (event) => {
      setDistrictShippingRef(event.target.value);
      inputdata(event);
      dispatch(shippingCost({ divisionId: userInfo.division, districtId: event.target.value }))
  
    }
  
  
    const [infoRequired, setinfoRequired] = useState(userInfodata);
    const inputdata = (e) => {
      let name = e.target.name;
      let dataValue = e.target.value;
      setUserInfo((prev) => ({ ...prev, [name]: dataValue }));
    };
    const placeOrder = () => {
      setinfoRequired(userInfodata);
      var isBreak = 0;
      const petList = Object.entries(userInfo).map(([key, value]) => {
        if (!value || value == 0) {
          value = "empty";
          isBreak = 1;
        }
        setinfoRequired((prev) => ({ ...prev, [key]: value }));
      });
      if (isBreak) {
        return false;
      }
  
  
      props.address(userInfo);
  
    };
  
    return <>
  
      <h6 class="mb-1 pb-3 checkout__txt "> Shipping Address </h6>
  
      <Form className="billing__form userInfoUse">
        <FormGroup className="form__group inputbasehulf mb-0">
          {/* https://tm-shopify076-clothes.myshopify.com/cart */}
  
          <h6 className="infoname__st">Name </h6>
          <Input
            type="text"
            name="name"
            value={userInfo.name}
            placeholder="Enter Your Name"
            onChange={inputdata}
          />
          {infoRequired.name == "empty" && (
            <span className="error__tx">Name is Required</span>
          )}
        </FormGroup>
        <FormGroup className="form__group inputbasehulf">
          <h6 className=" infoname__st">Email</h6>
          <Input
            value={userInfo.email}
            type="email"
            name="email"
            placeholder="Enter Your Email"
            onChange={inputdata}
          />
          {infoRequired.email == "empty" && (
            <span className="error__tx">Email is Required</span>
          )}
        </FormGroup>
        <FormGroup className="form__group inputbasehulf">
          <h6 className="infoname__st">Phone Number </h6>
          <Input
            value={userInfo.phone}
            type="number"
            name="phone"
            placeholder="Enter your Number"
            onChange={inputdata}
          />
          {infoRequired.phone == "empty" && (
            <span className="error__tx">Phone is Required</span>
          )}
        </FormGroup>
        <FormGroup className="form__group inputbasehulf">
          <h6 className="infoname__st">Address </h6>
          <Input
            value={userInfo.address}
            type="text"
            name="address"
            placeholder="Street address"
            onChange={inputdata}
          />
          {infoRequired.address == "empty" && (
            <span className="error__tx">Address is Required</span>
          )}
        </FormGroup>
   
  
        <FormGroup className="form__group inputbasehulf">
          <h6 className="infoname__st">Country </h6>
  
  
          <Input type="select" name="country" id="exampleSelect" value={userInfo.country} onChange={inputdata} placeholder="Country">
            {
              Object.keys(countryList).map((data, index) => {
                return <option value={countryList[data].name}>{countryList[data].name}</option>
              })
            }
          </Input>
  
          {infoRequired.country == "empty" && (
            <span className="error__tx">Country is Required</span>
          )}
        </FormGroup>
        <FormGroup className="form__group inputbasehulf">
          <h6 className="infoname__st">Division </h6>
  
  
          <Input type="select" name="division" id="exampleSelect" value={divisionShippingRef} onChange={onchangeDivision} placeholder="Division">
            <option value="0">SELECT DIVISION</option>
            {
              divisionList.map((data, index) => {
                return <option value={data.id}>{data.name}</option>
              })
            }
  
          </Input>
  
  
          {infoRequired.division == "empty" && (
            <span className="error__tx">Division is Required</span>
          )}
        </FormGroup>
        <FormGroup className="form__group inputbasehulf">
          <h6 className="infoname__st">District </h6>
  
  
  
          <Input type="select" name="district" id="exampleSelect" value={districtShippingRef} onChange={onChangeDistrict} placeholder="Country">
            <option value="0">SELECT DISTRICT</option>
            {
              districtList.map((data, index) => {
                return <option value={data.id}>{data.name}</option>
              })
            }
  
          </Input>
  
  
  
          {infoRequired.district == "empty" && (
            <span className="error__tx">District is Required</span>
          )}
        </FormGroup>
  
        <FormGroup className=" form__group inputbasehulf">
          <h6 className="infoname__st">Postal Code </h6>
          <Input
            type="text"
            value={userInfo.postal_code}
            name="postal_code"
            placeholder="Postal Code"
            onChange={inputdata}
          />
          {infoRequired.postal_code == "empty" && (
            <span className="error__tx">Postal Code is Required</span>
          )}
        </FormGroup>
  
      </Form>
      <div>
        <button
          className="buy__btn auth__btn w-100"
          onClick={placeOrder}
        >
          Shipping
        </button>
      </div>
    </>
  
  }

  export default OrderShippingAddress;