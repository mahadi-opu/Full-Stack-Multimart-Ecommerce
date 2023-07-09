import React, { useEffect, useState } from "react";
import ProductCard from "./ProductCard";
import "react-multi-carousel/lib/styles.css";
import axiosClient from "../../axios-client";
import "../../styles/fixed_product.css"

const FlexProductsList = (props) => {
  let [subcategoryId, setSucategoryId] = useState(props.subcategoryId);
  let [productList, setProductList] = useState([]);
  let [typoeSubcategoryId, settypoeSubcategoryId] = useState("All");

  useEffect(() => {
    // Check if the prop we care about has changed
    if (props.subcategoryId !== subcategoryId) {
      subCategoryChange(props.subcategoryId);
    }
  }, [props.subcategoryId]);

  let subCategoryChange = (id) => {
    settypoeSubcategoryId(id);
    setSucategoryId(props.subcategoryId);
  };

  useEffect(() => {
    if (props.offerId > 0) {
      axiosClient
        .get(
          `offer/product/list?offer_id=${props.offerId}&subcategory_id=${typoeSubcategoryId}`
        )
        .then(({ data }) => {
          console.log(data.data);
          setProductList(data.data);
        });
    } else if (props.type != "none") {
      axiosClient
        .get(
          `section/product?type=${props.type}&subcategory_id=${typoeSubcategoryId}`
        )
        .then(({ data }) => {
          console.log(data);
          setProductList(data.data);
        });
    } else {
      axiosClient
        .get(`home/subcategory/product?subCategory_id=${subcategoryId}`)
        .then(({ data }) => {
          setProductList(data.data);
        });
    }
  }, [subcategoryId, typoeSubcategoryId]);

  const responsive = {
    superLargeDesktop: {
      // the naming can be any, depends on you.
      breakpoint: { max: 4000, min: 3000 },
      items: 5,
    },
    desktop: {
      breakpoint: { max: 3000, min: 1024 },
      items: 5,
    },
    tablet: {
      breakpoint: { max: 1024, min: 464 },
      items: 2,
    },
    mobile: {
      breakpoint: { max: 464, min: 0 },
      items: 1,
    },
  };

  return (
    <>
      <div style={{ display: "flex", flexWrap: "wrap" }}>
        {productList?.map((item, index) => (
          <div className="product_section">
            <ProductCard item={item} key={index} offerId={props.offerId} />
          </div>
        ))}
      </div>
    </>
  );
};

export default FlexProductsList;
