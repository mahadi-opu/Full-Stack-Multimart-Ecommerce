import React from 'react';
import styles from '../../../Assets/CSS/Partials/Button.module.css';

const SectionHeadingBtn = ({name, link}) => {
    return (
        <>
            <div className={styles.SectionHeadingWrap}>
               <a href={link}>{name}</a>
            </div> 
        </>
    );
};

export default SectionHeadingBtn;