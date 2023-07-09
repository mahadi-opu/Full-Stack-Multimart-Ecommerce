import React from 'react';
import { Link } from 'react-router-dom';
import styles from '../../../Assets/CSS/Partials/Button.module.css';
const SeemoreButton = () => {
    return (
        <>
            <div className={styles.seeMoreBtn}>
                
                    <Link to={'#'}> See More </Link>
                
            </div>
        </>
    );
};

export default SeemoreButton;