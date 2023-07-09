import React from 'react';
import { Link } from 'react-router-dom';
import styles from '../../../Assets/CSS/Filter/Filter.module.css';


const TagFilter = () => {
    return (
        <>
            <div className={styles.TagName}>
                <label><Link to={'#'}>Web Design</Link></label>
                <label><Link to={'#'}>Graphich</Link></label>
                <label><Link to={'#'}>Writing</Link></label>
                <label><Link to={'#'}>Delevopment</Link></label>
                <label><Link to={'#'}>Marketing</Link></label>
                <label><Link to={'#'}>Codding</Link></label>
                <label><Link to={'#'}>web Delevopment</Link></label>
                <label><Link to={'#'}>Text</Link></label>
            </div>
        </>
    );
};

export default TagFilter;