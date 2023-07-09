import React from 'react';
import { RiArrowDownSLine } from 'react-icons/ri';
import styles from '../../../Assets/CSS/Filter/Filter.module.css'
import RatingsFilter from './RatingsFilter';
import TagFilter from './TagFilter';
import InstructorFilter from './InstructorFilter';
import LevelFilter from './LevelFilter';
import IndicatorFilter from './IndicatorFilter';
import TagSearch from '../Search/TagSearch';

const Filter = () => {
    return (
        <>
            <div className={styles.Filter}>

                <div className={styles.FilterWidget}>
                    <div className={styles.FilterTitle}>
                        <h2>Ratings</h2> 
                        <RiArrowDownSLine/>
                    </div>
                    <div className={styles.FilterEliment}>
                           <RatingsFilter/>
                    </div>
                </div>

                <div className={styles.FilterWidget}>
                    <div className={styles.FilterTitle}>
                        <h2>instructor</h2> 
                        <RiArrowDownSLine/>
                    </div>
                    <div className={styles.FilterEliment}>
                       <InstructorFilter/>
                    </div>
                </div>

                <div className={styles.FilterWidget}>
                    <div className={styles.FilterTitle}>
                        <h2>Price </h2> 
                        <RiArrowDownSLine/>
                    </div>
                    <div className={styles.FilterEliment}>
                        <IndicatorFilter/>
                    </div>
                </div>

                <div className={styles.FilterWidget}>
                    <div className={styles.FilterTitle}>
                        <h2>Level</h2> 
                        <RiArrowDownSLine/>
                    </div>
                    <div className='FilterEliment'>
                        <LevelFilter/>
                    </div>
                </div>

                <div className={styles.FilterWidget}>
                    <div className={styles.FilterTitle}>
                            <h2> Tag </h2> 
                            <TagSearch/>
                    </div>
                    <div className='FilterEliment'>
                        <TagFilter/>
                    </div>
                </div>
            </div>
        </>
    );
};

export default Filter;