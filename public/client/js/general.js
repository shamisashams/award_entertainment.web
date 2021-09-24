const menuBtn = document.getElementById("nav_menu");
const navbar = document.querySelector(".navbar");

const footer = document.getElementById("footer");
const openFooter = document.getElementById("footer_btn");
const closeFooter = document.getElementById("close_footer");
const container = document.getElementById("container");
const nav = document.querySelectorAll(".nav");
const openGallery = document.querySelectorAll(".open_gallery_details");
// const galleryBox = document.querySelectorAll(".gallery_box");
let galleryWrapper = document.querySelector(".gallery_outer_wrapper");

const galleryWrapperGallery = document.querySelector(
    ".gallery_outer_wrapper.gallery"
);
const galleryWrapperBlogs = document.querySelector(
    ".gallery_outer_wrapper.blogs"
);
const openGPopup = document.querySelectorAll(".open_gallery_popup");
const closePopup = document.querySelector(".close_popup");
const galleryPopup = document.querySelector(".gallery_popup");

const mainPages = document.querySelector(".main_pages");
const blogPage = document.getElementById("blog_page");
const reallyGalleryPage = document.getElementById("really_gallery_page");
const pageTitleBlog = document.getElementById("blog_title");
const pageTitleGallery = document.getElementById("gallery_title");
const logo = document.querySelector(".logo");
const leftLogos = document.querySelector(".left_logos");
const eachLeftLogo = document.querySelectorAll(".each_left_logo");
const goBack = () => {
    galleryWrapperBlogs.classList.remove("open");
    galleryWrapperGallery.classList.remove("open");
    mainPages.classList.remove("out");
    document.querySelector(".header").style.background = "transparent";
};
const getUrl = () => {
    navigator.clipboard.writeText(window.location.href);
    alert("Copied the text: " + window.location.href);
};

// header mobile

menuBtn.addEventListener("click", () => {
    navbar.classList.toggle("show");
    menuBtn.classList.toggle("clicked");
});

// footer
openFooter.addEventListener("click", () => {
    footer.classList.add("open");
    // galleryPage.classList.add("zindex");
});
closeFooter.addEventListener("click", () => {
    footer.classList.remove("open");
    // galleryPage.classList.remove("zindex");
});

// navs
nav.forEach((el, i) => {
    el.addEventListener("click", () => {
        nav.forEach((el) => {
            el.classList.remove("active");
        });
        nav[i].classList.add("active");
    });
});

// blog main page
if (mainPages) {
    openGallery.forEach((el) => {
        el.addEventListener("click", () => {
            galleryWrapperBlogs.classList.add("open");
            mainPages.classList.add("out");
            document.querySelector(".header").style.background = "#fff";

            let title = document.getElementById(
                "title_blog_" + el.id
            ).textContent;
            let date = document.getElementById(
                "date_blog_" + el.id
            ).textContent;
            let content = document.getElementById(
                "content_blog_" + el.id
            ).textContent;
            let location = document.getElementById(
                "location_blog_" + el.id
            ).textContent;
            let img = document.getElementById("img_blog_" + el.id).src;
            let blogContent = `<div class="wrapper">
                <section class="gallery_detail blogs flex">
                    <button class="flex go_back_btn" onclick="goBack()">
                        <img src="/img/icons/arrows/2.png" alt="" />
                        <div>Go Back</div>
                    </button>
                    <div class="img_overlay one">
                        <img src="${img}" alt="" />
                    </div>
                    <div class="two">
                        <div class="title">${title}</div>
                        <div class="flex info">
                            <a href="#" class="flex"
                            ><img src="/img/icons/blog/1.png" alt="" />
                                <div>${location}</div></a
                            >
                            <a href="#" class="flex"
                            ><img src="/img/icons/blog/2.png" alt="" />
                                <div>${date}</div></a
                            >
                        </div>
                        <div class="flex sm">
                            <div class="copy-link" onclick="getUrl()">
                            <img class="copy-link-img" src="/img/icons/blog/4.svg" />
                            </div>
<!--                            <a href="#">-->
<!--                                <div class="flex center">-->
<!--                                    <svg-->
<!--                                        xmlns="http://www.w3.org/2000/svg"-->
<!--                                        width="24"-->
<!--                                        height="24"-->
<!--                                        viewBox="0 0 24 24"-->
<!--                                    >-->
<!--                                        <g-->
<!--                                            id="Group_553"-->
<!--                                            data-name="Group 553"-->
<!--                                            transform="translate(13071 -21919)"-->
<!--                                        >-->
<!--                                            <g-->
<!--                                                id="Rectangle_273"-->
<!--                                                data-name="Rectangle 273"-->
<!--                                                transform="translate(-13071 21919)"-->
<!--                                                fill="#fff"-->
<!--                                                stroke="#707070"-->
<!--                                                stroke-width="1"-->
<!--                                                opacity="0"-->
<!--                                            >-->
<!--                                                <rect width="24" height="24" stroke="none" />-->
<!--                                                <rect-->
<!--                                                    x="0.5"-->
<!--                                                    y="0.5"-->
<!--                                                    width="23"-->
<!--                                                    height="23"-->
<!--                                                    fill="none"-->
<!--                                                />-->
<!--                                            </g>-->
<!--                                            <path-->
<!--                                                id="Icon_awesome-facebook-f"-->
<!--                                                data-name="Icon awesome-facebook-f"-->
<!--                                                d="M8.6,7.854l.388-2.527H6.561V3.687A1.263,1.263,0,0,1,7.985,2.322h1.1V.171A13.442,13.442,0,0,0,7.131,0a3.085,3.085,0,0,0-3.3,3.4V5.327H1.609V7.854h2.22v6.109H6.561V7.854Z"-->
<!--                                                transform="translate(-13064.75 21924.02)"-->
<!--                                            />-->
<!--                                        </g>-->
<!--                                    </svg>-->
<!--                                </div>-->
<!--                            </a>-->

                        </div>
                        <!-- <div class="flex">
                          <img src="img/sec2/2.png" alt="" />
                        </div> -->
                    </div>
                    <div class="paragraph">
                        ${content}
                    </div>
                </section>
            </div>`;
            galleryWrapperBlogs.innerHTML = blogContent;
        });
    });
}
// gallery main page
// if (mainPages) {
//     galleryBox.forEach((el) => {
//         el.addEventListener("click", () => {
//             galleryWrapperGallery.classList.add("open");
//             mainPages.classList.add("out");
//             document.querySelector(".header").style.background = "#fff";
//             let title = document.getElementById("title_gallery_" + el.id).value;
//             let content_1 = document.getElementById(
//                 "content_1_gallery_" + el.id
//             ).textContent;
//             let content_2 = document.getElementById(
//                 "content_2_gallery_" + el.id
//             ).textContent;
//             let video =
//                 "https://www.youtube.com/embed/" +
//                 document.getElementById("video_gallery_" + el.id).value;
//             let videoTag2 = "";
//             let images = JSON.parse(
//                 document.getElementById("images_gallery_" + el.id).value
//             );
//             let image = "";
//             let count = 0;
//             for (var i = 1; i < images.length; i++) {
//                 if (count == 0) {
//                     image +=
//                         '<div class="img_overlay large"><img src=/' +
//                         images[i]["path"] +
//                         "/" +
//                         images[i]["title"] +
//                         ' alt="" /></div>';
//                 } else {
//                     image +=
//                         '<div class="img_overlay"><img src=/' +
//                         images[i]["path"] +
//                         "/" +
//                         images[i]["title"] +
//                         ' alt="" /></div>';
//                 }
//                 count++;
//                 if (count > 3) {
//                     count = 0;
//                 }
//             }
//             if (video.length > 30) {
//                 videoTag2 =
//                     '<div class="video_placeolder"><iframe width="560" height="315" src=' +
//                     video +
//                     ' title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>\n';
//             }
//
//             let galleryContent = `<div class="wrapper">
//                 <section class="gallery_detail gallery flex">
//                     <button class="flex go_back_btn" onclick="goBack()">
//                         <img src="img/icons/arrows/2.png" alt="" />
//                         <div>Go Back</div>
//                     </button>
//                     <div class="img_overlay one">
//                         <img src="/${images[0]["path"]}/${images[0]["title"]}" alt="" />
//                     </div>
//                     <div class="two">
//                         <div class="title">${title}</div>
//                         <div class="paragraph flex">
//                             <img src="img/sec2/2.png" alt="" />
//                             <div>
//                                  ${content_1}
//                             </div>
//                         </div>
//                         <div class="circle flex center">
//                             <div class="img">
//                                 <img src="img/sec2/1.png" alt="" />
//                             </div>
//                         </div>
//                     </div>
//                     <div class="slider_gallery_page">
//                         <div class="img_overlay slider_item">
//                             <img src="img/sec1/1.png" alt="" />
//                         </div>
//                         <div class="img_overlay slider_item">
//                             <img src="img/sec1/2.png" alt="" />
//                         </div>
//                         <div class="img_overlay slider_item">
//                             <img src="img/sec1/3.png" alt="" />
//                         </div>
//                     </div>
//                     ${videoTag2}
//                     <div class="three flex">
//                         <div class="title">Lorem Ipsum</div>
//                         <div class="paragraph">
//                             ${content_2}
//                         </div>
//                     </div>
//                     <div class="grid">
//                         ${image}
//                     </div>
//                 </section>
//             </div>`;
//             galleryWrapperGallery.innerHTML = galleryContent;
//             $(".slider_gallery_page").slick({
//                 draggable: true,
//                 arrows: false,
//                 dots: true,
//                 fade: true,
//                 speed: 900,
//                 autoplay: true,
//                 autoSpeed: 4000,
//                 infinite: true,
//                 cssEase: "cubic-bezier(0.7, 0, 0.3, 1)",
//                 touchThreshold: 100,
//                 pauseOnHover: false,
//             });
//         });
//     });
// }
// if (goBack) {
//     goBack.forEach((el) => {
//         el.addEventListener("click", () => {
//             galleryWrapperBlogs.classList.remove("open");
//             galleryWrapperGallery.classList.remove("open");
//             mainPages.classList.remove("out");
//             console.log("clicked");
//             document.querySelector(".header").style.background = "transparent";
//         });
//     });
// }

//blog page
if (blogPage) {
    openGallery.forEach((el) => {
        el.addEventListener("click", () => {
            galleryWrapper.classList.add("open");
            blogPage.classList.add("clicked");
            pageTitleBlog.classList.add("clicked");

            let title = document.getElementById("title_" + el.id).textContent;
            let date = document.getElementById("date_" + el.id).textContent;
            let content = document.getElementById(
                "content_" + el.id
            ).textContent;

            let location = document.getElementById(
                "location_" + el.id
            ).textContent;

            let img = document.getElementById("img_" + el.id).src;
            // console.log(img);

            let blogView = `<div class="wrapper">
                <section class="gallery_detail blogs flex">
                    <div class="img_overlay one">
                        <img src="${img}" alt=""/>
                    </div>
                    <div class="two">
                        <div class="title">${title}</div>
                        <div class="flex info">
                            <a href="#" class="flex"
                            ><img src="/img/icons/blog/1.png" alt=""/>
                                <div>${location}</div>
                            </a
                            >
                            <a href="#" class="flex"
                            ><img src="/img/icons/blog/2.png" alt=""/>
                                <div>${date}</div>
                            </a
                            >
                        </div>
                        <div class="flex sm">
                        <div class="copy-link" onclick="getUrl()">
                            <img class="copy-link-img" src="/img/icons/blog/4.svg" />
                            </div>
<!--                        <a onclick="getUrl()"><img src="/img/icons/blog/4.svg" alt=""></a>-->
<!--                            <a href="#">-->
<!--                                <div class="flex center">-->
<!--                                    <svg-->
<!--                                        xmlns="http://www.w3.org/2000/svg"-->
<!--                                        width="24"-->
<!--                                        height="24"-->
<!--                                        viewBox="0 0 24 24"-->
<!--                                    >-->
<!--                                        <g-->
<!--                                            id="Group_553"-->
<!--                                            data-name="Group 553"-->
<!--                                            transform="translate(13071 -21919)"-->
<!--                                        >-->
<!--                                            <g-->
<!--                                                id="Rectangle_273"-->
<!--                                                data-name="Rectangle 273"-->
<!--                                                transform="translate(-13071 21919)"-->
<!--                                                fill="#fff"-->
<!--                                                stroke="#707070"-->
<!--                                                stroke-width="1"-->
<!--                                                opacity="0"-->
<!--                                            >-->
<!--                                                <rect width="24" height="24" stroke="none"/>-->
<!--                                                <rect-->
<!--                                                    x="0.5"-->
<!--                                                    y="0.5"-->
<!--                                                    width="23"-->
<!--                                                    height="23"-->
<!--                                                    fill="none"-->
<!--                                                />-->
<!--                                            </g>-->
<!--                                            <path-->
<!--                                                id="Icon_awesome-facebook-f"-->
<!--                                                data-name="Icon awesome-facebook-f"-->
<!--                                                d="M8.6,7.854l.388-2.527H6.561V3.687A1.263,1.263,0,0,1,7.985,2.322h1.1V.171A13.442,13.442,0,0,0,7.131,0a3.085,3.085,0,0,0-3.3,3.4V5.327H1.609V7.854h2.22v6.109H6.561V7.854Z"-->
<!--                                                transform="translate(-13064.75 21924.02)"-->
<!--                                            />-->
<!--                                        </g>-->
<!--                                    </svg>-->
<!--                                </div>-->
<!--                            </a>-->
                        </div>

                        <div class="paragraph">
                          ${content}
                        </div>
                    </div>


                </section>
            </div>`;
            galleryWrapper.innerHTML = blogView;
        });
    });
}

//gallery page
// if (reallyGalleryPage) {
//     galleryBox.forEach((el) => {
//         el.addEventListener("click", () => {
//             galleryWrapper.classList.add("open");
//             reallyGalleryPage.classList.add("clicked");
//             pageTitleGallery.classList.add("clicked");
//             let title = document.getElementById("title_gallery_" + el.id).value;
//             let content_1 = document.getElementById(
//                 "content_1_gallery_" + el.id
//             ).textContent;
//             let content_2 = document.getElementById(
//                 "content_2_gallery_" + el.id
//             ).textContent;
//             let video =
//                 "https://www.youtube.com/embed/" +
//                 document.getElementById("video_gallery_" + el.id).value;
//             let videoTag = "";
//             let images = JSON.parse(
//                 document.getElementById("images_gallery_" + el.id).value
//             );
//             let image = "";
//             let count = 0;
//             for (var i = 1; i < images.length; i++) {
//                 if (count == 0) {
//                     image +=
//                         '<div class="img_overlay large"><img src=/' +
//                         images[i]["path"] +
//                         "/" +
//                         images[i]["title"] +
//                         ' alt="" /></div>';
//                 } else {
//                     image +=
//                         '<div class="img_overlay"><img src=/' +
//                         images[i]["path"] +
//                         "/" +
//                         images[i]["title"] +
//                         ' alt="" /></div>';
//                 }
//                 count++;
//                 if (count > 3) {
//                     count = 0;
//                 }
//             }
//             if (video.length > 30) {
//                 videoTag =
//                     '<div class="video_placeolder"><iframe\nwidth="560"\nheight="315"src=' +
//                     video +
//                     ' title="YouTube video player" frameborder="0"allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"allowfullscreen></iframe></div>';
//             }
//             let galleryView = `<div class="wrapper">
//                 <section class="gallery_detail gallery flex">
//                     <div class="img_overlay one">
//                     <img src="/${images[0]["path"]}/${images[0]["title"]}" alt="" />
//                     </div>
//                     <div class="two">
//                         <div class="title">${title}</div>
//                         <div class="paragraph flex">
//                             <img src="/img/sec2/2.png" alt=""/>
//                             <div>
//                                 ${content_1}
//                             </div>
//                         </div>
//                         <div class="circle flex center">
//                             <div class="img">
//                                 <img src="/img/sec2/1.png" alt=""/>
//                             </div>
//                         </div>
//                     </div>
//                     <div class="slider_gallery_page">
//                         <div class="img_overlay slider_item">
//                             <img src="/img/sec1/1.png" alt=""/>
//                         </div>
//                         <div class="img_overlay slider_item">
//                             <img src="/img/sec1/2.png" alt=""/>
//                         </div>
//                         <div class="img_overlay slider_item">
//                             <img src="/img/sec1/3.png" alt=""/>
//                         </div>
//                     </div>
//                     ${videoTag}
//                     <div class="three flex">
//                         <div class="title">Lorem Ipsum</div>
//                         <div class="paragraph">
//                             ${content_2}
//                         </div>
//                     </div>
//                     <div class="grid">
//                         ${image}
//                     </div>
//                 </section>
//             </div>`;
//             galleryWrapper.innerHTML = galleryView;
//             $(".slider_gallery_page").slick({
//                 draggable: true,
//                 arrows: false,
//                 dots: true,
//                 fade: true,
//                 speed: 900,
//                 autoplay: true,
//                 autoSpeed: 4000,
//                 infinite: true,
//                 cssEase: "cubic-bezier(0.7, 0, 0.3, 1)",
//                 touchThreshold: 100,
//                 pauseOnHover: false,
//             });
//         });
//     });
// }
if (pageTitleBlog) {
    pageTitleBlog.addEventListener("click", () => {
        galleryWrapper.classList.remove("open");
        blogPage.classList.remove("clicked");
        pageTitleBlog.classList.remove("clicked");
    });
}
if (pageTitleGallery) {
    pageTitleGallery.addEventListener("click", () => {
        window.history.back();
        // galleryWrapper.classList.remove("open");
        // reallyGalleryPage.classList.remove("clicked");
        // pageTitleGallery.classList.remove("clicked");
    });
}

// left logos
logo.addEventListener("click", () => {
    leftLogos.classList.toggle("show");
});

// gallery popup
if ((openGPopup, galleryPopup)) {
    openGPopup.forEach((el) => {
        el.addEventListener("click", () => {
            galleryPopup.classList.add("open");
            console.log("clicked");
        });
    });
    closePopup.addEventListener("click", () => {
        galleryPopup.classList.remove("open");
    });
}

// const handleHover = function (e) {
//     if (e.target.classList.contains("each_left_logo")) {
//         const link = e.target;
//         const siblings = link
//             .closest(".left_logos")
//             .querySelectorAll(".each_left_logo");
//         siblings.forEach((el) => {
//             if (el !== link) el.style.opacity = this;
//         });
//     }
// };

// // Passing "argument" into handler
// leftLogos.addEventListener("mouseover", handleHover.bind(0.5));
// leftLogos.addEventListener("mouseout", handleHover.bind(1));

eachLeftLogo.forEach((el) => {
    console.log(el)
    el.addEventListener("mouseover", () => {
        console.log("asd");
        eachLeftLogo.forEach((el) => {
            el.style.opacity = "0.5";
        });
        el.style.opacity = "1";
    });
    el.addEventListener("mouseout", () => {
        eachLeftLogo.forEach((el) => {
            el.style.opacity = "1";
        });
    });
});
