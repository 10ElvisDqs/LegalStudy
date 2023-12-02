import {search} from './export_search.js';

const mysearchp=document.querySelector('#mysearch');
const ul_add_lip=document.querySelector('#showlist');
const myurlp="/myurl";

const searchproduc=new search(myurlp,mysearchp,ul_add_lip);
searchproduc.InputSearch();

