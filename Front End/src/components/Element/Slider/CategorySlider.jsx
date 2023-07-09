import React from 'react';
import Slider from "react-slick";
import CategoryCard from '../../Elements/Card/CategoryCard';
import styles from'../../../Assets/CSS/Slider/Slider.module.css'


import one from '../../../Assets/Images/Category-Slider/1Amar-Skill-Icon1 1.png';
import two from '../../../Assets/Images/Category-Slider/1Amar-Skill-Icon1 1.png';
import three from '../../../Assets/Images/Category-Slider/Amar-Skill-Icon3 1.png';
import four from '../../../Assets/Images/Category-Slider/Amar-Skill-Icon4 1.png';
import five from '../../../Assets/Images/Category-Slider/Amar-Skill-Icon3 1.png';
import six from '../../../Assets/Images/Category-Slider/1Amar-Skill-Icon1 1.png';
import seven from '../../../Assets/Images/Category-Slider/1Amar-Skill-Icon1 1.png';


const CategorySlider = () => {

    var settings = {
        dots: true,
        infinite: false,
        speed: 500,
        slidesToShow: 5,
        slidesToScroll: 4,
        initialSlide: 0,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              initialSlide: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      };

    return (
        <>
            <div>
                <Slider {...settings}>
                    <div className={styles.cardMargin2}>
                        <CategoryCard
                            icon={one}
                            title="Web Development"
                            cat_link="#"
                        />
                    </div>
                    <div className={styles.cardMargin2}>
                        <CategoryCard
                            icon={two}
                            title="Web Development"
                            cat_link="#"
                        />
                    </div>
                    <div className={styles.cardMargin2}>
                        <CategoryCard
                            icon={three}
                            title="Web Development"
                            cat_link="#"
                        />
                    </div>
                    <div className={styles.cardMargin2}>
                        <CategoryCard
                            icon={five}
                            title="Web Development"
                            cat_link="#"
                        />
                    </div>
                    <div className={styles.cardMargin2}>
                        <CategoryCard
                            icon={three}
                            title="Web Development"
                            cat_link="#"
                        />
                    </div>
                    <div className={styles.cardMargin2}>
                        <CategoryCard
                            icon={four}
                            title="Web Development"
                            cat_link="#"
                        />
                    </div>
                    <div className={styles.cardMargin2}>
                        <CategoryCard
                            icon={six}
                            title="Web Development"
                            cat_link="#"
                        />
                    </div>
                    <div className={styles.cardMargin2}>
                        <CategoryCard
                            icon={seven}
                            title="Web Development"
                            cat_link="#"
                        />
                    </div>
                </Slider>
            </div>
        </>
    );
};

export default CategorySlider;