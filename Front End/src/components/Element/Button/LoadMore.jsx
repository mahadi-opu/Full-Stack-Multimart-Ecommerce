import React from 'react';
import { Link } from 'react-router-dom';
import styles from '../../../Assets/CSS/Partials/Button.module.css'
import { MdDoubleArrow } from "react-icons/md";

const LoadMore = ({name,Customurl}) => {
    return (
        <div className={styles.LoadMorebtn}>
            <Link to={Customurl}> {name}<MdDoubleArrow/> </Link>
        </div>
    );
};

export default LoadMore;