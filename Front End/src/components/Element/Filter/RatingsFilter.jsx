import React from 'react';
import styles from '../../../Assets/CSS/Filter/Filter.module.css';
import { AiFillStar, AiOutlineStar } from "react-icons/ai";

const RatingsFilter = () => {
    return (
        <>
            <ul className='list-unstyled mb-0'>
                <li>
                    <div className={styles.RattingFilterRawp}>
                        <div className={styles.RedioName}> 
                            <label> <input type="radio" name='radio'/>Five Star </label>
                        </div>
                        <div> --- </div>
                        <div>
                            <AiFillStar/>
                            <AiFillStar/>
                            <AiFillStar/>
                            <AiFillStar/>
                            <AiFillStar/>
                           
                        </div>
                    </div>
                </li>

                <li>
                    <div className={styles.RattingFilterRawp}>
                        <div className={styles.RedioName}>
                             <label> <input type="radio" name='radio'/>Five Star </label>
                        </div>
                        <div> --- </div>
                        <div>
                            <AiFillStar/>
                            <AiFillStar/>
                            <AiFillStar/>
                            <AiFillStar/>
                            <AiOutlineStar/>
                        </div>
                    </div>
                </li>

                <li>
                    <div className={styles.RattingFilterRawp}>
                        <div className={styles.RedioName}> 
                            <label> <input type="radio" name='radio'/>Five Star </label>
                        </div>
                        <div> --- </div>
                        <div>
                            <AiFillStar/>
                            <AiFillStar/>
                            <AiFillStar/>
                            <AiOutlineStar/>
                            <AiOutlineStar/>
                        </div>
                    </div>
                </li>

                <li>
                    <div className={styles.RattingFilterRawp}>
                        <div className={styles.RedioName}> 
                            <label> <input type="radio" name='radio'/>Five Star </label> 
                        </div>
                        <div> --- </div>
                        <div>
                            <AiFillStar/>
                            <AiFillStar/>
                            <AiOutlineStar/>
                            <AiOutlineStar/>
                            <AiOutlineStar/>
                        </div>
                    </div>
                </li>

                <li>
                    <div className={styles.RattingFilterRawp}>
                        <div className={styles.RedioName}>
                            <label> <input type="radio" name='radio'/>Five Star </label>
                        </div>
                        <div> --- </div>
                        <div>
                            <AiFillStar/>
                            <AiOutlineStar/>
                            <AiOutlineStar/>
                            <AiOutlineStar/>
                            <AiOutlineStar/>
                        </div>
                    </div>
                </li>
            </ul>
        </>
    );
};

export default RatingsFilter;







