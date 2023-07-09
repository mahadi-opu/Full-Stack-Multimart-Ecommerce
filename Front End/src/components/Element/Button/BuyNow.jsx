import React from 'react';
import { Link } from 'react-router-dom';
import styles from '../../../Assets/CSS/Partials/Button.module.css';

const BuyNow = ({name, link}) => {
    return (
        <div className={styles.BuyNowBtn}>
            <button><Link to={link}>{name} </Link></button>
        </div>
    );
};

export default BuyNow;