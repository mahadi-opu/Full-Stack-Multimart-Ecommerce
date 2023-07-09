import React from 'react';
import { Link } from 'react-router-dom';
import styles from '../../../Assets/CSS/Partials/Button.module.css';

const BuyNowBtnBig = ({name, link}) => {
    return (
        <div className={styles.BuyNowBtnBig}>
            <button><Link to={link}>{name} </Link></button>
        </div>
    );
};

export default BuyNowBtnBig;