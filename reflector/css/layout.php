<?php

   header("Content-type: text/css");

   include("./theme.php");

?>


/* --------------- Custom Fonts - Braille Institute Easy Read --------------- */

@import url('https://cdn.jsdelivr.net/npm/@fontsource-variable/atkinson-hyperlegible-next@5.3.0/index.css');

/* ----------------------- Global Properties Section ------------------------ */

:root {

   --mainbackground     : <?=$bgclr?>;
   --headerbackground   : <?=$hdr?>;
   --footerbackground   : <?=$ftr?>;
   --primarydark        : <?=$pridk?>;
   --primarymid         : <?=$primid?>;
   --primarylight       : <?=$prilt?>;
   --secondarydark      : <?=$secdk?>;
   --secondarymid       : <?=$secmid?>;
   --secondarylight     : <?=$seclt?>;
   --tertiarydark       : <?=$terdk?>;
   --tertiarymid        : <?=$termid?>;
   --tertiarylight      : <?=$terlt?>;
   --quarternarydark    : <?=$quadk?>;
   --quarternarymid     : <?=$quamid?>;
   --quarternarylight   : <?=$qualt?>;
   --navbartext         : <?=$navtxt?>;
   --border             : <?=$brdr?>;
   --tableheadertext    : <?=$tabhdr?>;
   --oddrow       		: <?=$odrw?>;
   --buttontext         : <?=$buttxt?>;
   --errortext    		: <?=$errtxt?>;
   --errorbackground    : <?=$errbg?>;

   color	: var(--primarydark);
   background	: var(--mainbackground);

   font-family	: 'Atkinson Hyperlegible Next Variable', sans-serif;
   font-weight	: 400;
   font-style	: normal;
   min-width	: 450px;

}


/* ------------------------- Flex Container Section ------------------------- */

/* Flexible / Responsive Tag */

* {
   box-sizing  : border-box;
   margin      : 0;
}

/* Flex Container Properties */

.flex-container{
    display         : flex;
    flex-direction  : row;
    justify-content : center;
}

/* Flex Container Layout Properties */

/*
@media (max-width: 1000px) {
  .flex-container {
    flex-direction: column;
  }
}
*/

@media (max-width: 750px) {
  .flex-container {
    flex-direction: column;
  }
}


/* ----------------------------- Layout Section ----------------------------- */

/* Overall Body Properties */

body {
   font-weight : bold;
   font-size   : 0.875em;
   text-align  : center;
   text-wrap   : balance;
   margin      : 0px
}


/* Header Properties */

.header {
   position          : sticky;
   width		         : 100%;
   top               : 0px;
   left              : 0px;
   padding           : 0em;
   z-index           : 1;
   background        : var(--headerbackground);
   background-repeat : repeat-x;
   background-image  : url("https://m8wat.github.io/reflector/img/line.svg");
   font-size         : 0.75em;0
   overflow          : hidden;0
}

.header p {
   padding     : 0em 0.5em 0.25em; /* Top Sides Bottom */
}


/* Footer Properties */

.footer {
   position    : fixed;
   width       : 100%;
   height      : 2.5em;
   bottom      : 0px;
   padding     : 0.625em 0em;
   z-index     : 1;
   background  : var(--footerbackground);
   color       : var(--primarylight);
   font-size   : 0.75em;
}


/* Page Content Properties */

.content {
   position       : relative;
   width          : 100%;
   padding-bottom : 2.5em;
   overflow       : hidden;
}


/* DVSwitch Dashboard Properties */

.dvswitch-container {
   position: inherit;
   width: 100%;
   height: auto;
   max-width: 920px;
}


/* ---------------------- Hyperlink Properties Section ---------------------- */

a {
   color             : var(--secondarymid);
   text-decoration   : none;
}

a.img {
   border	         : 0;
}

a.tip {
   text-decoration   : none;
}

a.tip:hover {
   position          : relative;
}

a.tip span {
   display           : none;
}

a.tip:hover span {
   background        : var(--primarylight);
   opacity           : 1;
   border            : 0.0625em var(--border) solid;
   border-radius     : 0.3125em;
   font-size         : 0.75em;
   text-decoration   : none;
   white-space       : nowrap;
   color             : var(--primarydark);
   padding           : 0.375em;
   margin            : 0.625em;
   display           : block;
   z-index           : 50;
   position          : absolute;
   top               : 0.625em;
}


/* ----------------------- Navbar Properties Section ------------------------ */

.navbar {
   color       : var(--navbartext);
   background  : var(--primarydark);
   display: flex;
   justify-content: center;
   align-items: center;
   font-size   : 1em;
}

.navbar a {
   color   : var(--navbartext);
   padding : 0.6875em 0.875em;
   display : table-cell;
   vertical-align : middle;
}

.navbar a:hover {
   background : var(--primarylight);
   color      : var(--primarydark);
}

.navbarlink {
   background : var(--primarydark);
   color      : var(--navbartext);
}

.navbarlinkactive {
   background : var(--secondarymid);
   color      : var(--navbartext);
}

.navbar button {
   font           : inherit;
   border         : 0px;
   padding        : 0.6875em 0.875em;
   display        : table-cell;
   vertical-align : middle;
}

.paused {
   background : var(--secondarydark);
   color      : var(--navbartext);
}

.playing {
   background : var(--tertiarymid);
   color      : var(--navbartext);
}   

/* ------------------------ Table Properties Section ------------------------ */

/* Table Basic Structure */
.listingtable {
   border         : 1px var(--border) solid;
   margin         : 0.625em;
   font-size      : 0.75em;
   font-weight    : normal;
   text-align     : center;
   vertical-align : middle;
   line-height    : 2.25;
}

/* Table Header */
.listingtable th {
   padding        : 0em 0.875em;
   color		      : var(--tableheadertext);
   background     : var(--primarydark);
   font-size      : 1em;
   font-weight    : bold;
}

/* Table Rows */
.listingtable tr {
}

/* Table Data */
.listingtable td {
   padding        : 0em 0.75em;
   overflow-wrap  : anywhere;
}

/* Table Hyperlink */
.listingtable a {
   color		      : var(--primarydark);
}

/* Table Images (Flags) */
.listingtable td img {
   max-width      : 100%;
   max-height     : 100%;
   text-align     : center;
   vertical-align : middle;
   object-fit     : contain;
}

/* -------------------- Other Custom Properties Section --------------------- */

h1 {
   font-size   : 1.5em;
}

mark {
   background  : inherit;
   color       : var(--secondarymid);
}


/* --------------------------- Responsive Section --------------------------- */

/* Phone Screen Settings */

@media only screen and (max-width: 620px) {
   body {
      font-size: 14px;
   }
   .header {
      background-image: none;
   }
   img {
      max-width: 100%;
      height: auto;
   }
   hide {
      display: none;
   }
   .listingtable {
     font-weight: bold;
   }
}


/* Tablet Screen Settings */

@media only screen and (min-width: 620px){
   body {
      font-size: 18px;
   }
   img {
      max-width: 100%;
      height: auto
   }
}


/* PC Screen Settings */

/*
@media only screen and (min-width: 1000px) {
   body {
      font-size: 20px;
   }
}
*/

@media only screen and (min-width: 800px) {
   body {
      font-size: 20px;
   }
}


/* ------------------------- Error Message Section -------------------------- */

.error {
   font-size         : 0.75em;
   text-decoration   : none;
   font-weight       : bold;
   color             : var(--errortext);
   background        : var(--errorbackground);
   width             : 90%;
   padding           : 0.9375em;
   margin            : 0.3125em;
}
