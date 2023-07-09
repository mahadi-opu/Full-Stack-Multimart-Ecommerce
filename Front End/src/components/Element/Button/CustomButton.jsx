/* eslint-disable jsx-a11y/anchor-is-valid */
import React from 'react';
import styles from '../../../Assets/CSS/Partials/Button.module.css';

const CustomButton = ({name, link}) => {
    return (
        <>
           <div className={styles.ButtonWrap}>
               <a href={link}>{name}</a>
            </div> 
        </>
    );
};

export default CustomButton;