import React from 'react';
import Slider from "react-slick";
import SmallCourseCard from '../Card/SmallCourseCard';
import styles from '../../../Assets/CSS/Slider/Slider.module.css';



const PopularSlider = () => {

    var settings = {
        dots: true,
        infinite: false,
        speed: 500,
        slidesToShow: 4,
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

                    <div>
                      <div className={styles.CardMargin}>
                            <SmallCourseCard
                                  money="200" 
                                  currency="TK." 
                                  btnLabel="BUY NOW" 
                                  courseTitle={'কন্সেপ্ট অফ জাফাস্ক্রিপ্ট কোর্স জিরো টু হিরো।'}
                                  instructor="Maruf Hossain"
                                  currencyPosition=""
                            />
                        </div>
                    </div>

                    <div>
                      <div className={styles.CardMargin}>
                          <SmallCourseCard
                              money="200" 
                              currency="TK." 
                              btnLabel="BUY NOW" 
                              courseTitle={'কন্সেপ্ট অফ জাফাস্ক্রিপ্ট কোর্স জিরো টু হিরো।'}
                              instructor="Maruf Hossain"
                              currencyPosition=""
                          />
                        </div>
                    </div>

                    <div>
                        <div className={styles.CardMargin}>
                                <SmallCourseCard
                                  money="200" 
                                  currency="TK." 
                                  btnLabel="BUY NOW" 
                                  courseTitle={'কন্সেপ্ট অফ জাফাস্ক্রিপ্ট কোর্স জিরো টু হিরো।'}
                                  instructor="Maruf Hossain"
                                  currencyPosition=""
                                />
                          </div>
                    </div>

                    <div>
                        <div className={styles.CardMargin}>
                            <SmallCourseCard
                                  money="200" 
                                  currency="TK." 
                                  btnLabel="BUY NOW" 
                                  courseTitle={'কন্সেপ্ট অফ জাফাস্ক্রিপ্ট কোর্স জিরো টু হিরো।'}
                                  instructor="Maruf Hossain"
                                  currencyPosition=""
                            />
                          </div>
                    </div>

                    <div>
                      <div className={styles.CardMargin}>
                          <SmallCourseCard
                              money="200" 
                              currency="TK." 
                              btnLabel="BUY NOW" 
                              courseTitle={'কন্সেপ্ট অফ জাফাস্ক্রিপ্ট কোর্স জিরো টু হিরো।'}
                              instructor="Maruf Hossain"
                              currencyPosition=""
                          />
                        </div>
                    </div>

                </Slider>
            </div>
        </>
    );
};

export default PopularSlider;