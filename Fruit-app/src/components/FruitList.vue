<template>
  <div class="text-sm font-medium text-center text-gray-700 border-b border-gray-400">
    <ul class="flex flex-wrap -mb-px">
        <li class="mr-2">
            <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" :class="[ pageTitle === AllFruit_Title ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-300' ]" @click="() => toggleTab(AllFruit_Title)">{{AllFruit_Title}}</a>
        </li>
        <li class="mr-2">
            <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" :class="[ pageTitle === FavorFruit_Title ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-300' ]" @click="() => toggleTab(FavorFruit_Title)">{{FavorFruit_Title}}</a>
        </li>
    </ul>
  </div>
  <div class="mx-auto py-6">
        <h1 class="text-3xl font-bold mb-6">{{ pageTitle }}</h1>
        <form class="flex flex-row mb-1 sm:mb-0 pb-3 justify-between">
          <div class="flex items-center">
            <label class="inline-block font-bold mb-2 mr-2 " for="name">Name:</label>
            <input class="border rounded py-2 px-3 w-64" type="text" id="name" v-model="filter.name" />
          </div>
          <div class="flex items-center">
            <label class="inline-block font-bold mb-2 mr-2" for="family">Family:</label>
            <input class="border rounded py-2 px-3 w-64" type="text" id="family" v-model="filter.family" />
          </div>
        </form>
        <table class="overflow-x-auto text-sm text-left text-gray-300  border-collapse border border-slate-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-400">
            <tr class="text-center border-collapse">
              <th scope="col" class="px-4 py-3 border border-slate-600" rowspan="2">
                Name
              </th>
              <th scope="col" class="px-4 py-3 border border-slate-600" rowspan="2">
                Family
              </th>
              <th scope="col" class="px-4 py-3 border border-slate-600" rowspan="2">
                Order
              </th>
              <th scope="col" class="px-4 py-3 border border-slate-600" rowspan="2">
                Genus
              </th>
              <th scope="col" class="px-4 py-3 border border-slate-600" colspan="5">
                Nutrition
              </th>
              <th scope="col" class="px-4 py-3 border border-slate-600" rowspan="2">
                Favourite
              </th>
            </tr>
            <tr class="border-collapse border border-slate-500" >
              <th class="px-4 py-3 border border-slate-600">Calories</th>
              <th class="px-4 py-3 border border-slate-600">Fat</th>
              <th class="px-4 py-3 border border-slate-600">Sugar</th>
              <th class="px-4 py-3 border border-slate-600">Carbohydrates</th>
              <th class="px-4 py-3 border border-slate-600">Protein</th>
            </tr>
          </thead>
          <tbody>
            <template v-if="pageTitle === AllFruit_Title">
              <tr v-for="fruit in paginatedFruits" :key="fruit.id" class="bg-gray-600 rounded-lg shadow-md p-4 text-center border-collapse border border-slate-500">
                <td>{{fruit.name}}</td>
                <td>{{fruit.family}}</td>
                <td>{{fruit.fruitOrder}}</td>
                <td>{{fruit.genus}}</td>
                <td>{{fruit.nutrition.calories}}</td>
                <td>{{fruit.nutrition.fat}}</td>
                <td>{{fruit.nutrition.sugar}}</td>
                <td>{{fruit.nutrition.carbohydrates}}</td>
                <td>{{fruit.nutrition.protein}}</td>
                <td class="w-4 p-4">
                  <div class="flex items-center">
                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold rounded" @click="toggleFavorite(fruit)">
                      {{ isFavorite(fruit) ? 'Remove' : 'Add' }}
                    </button>
                  </div>
                </td>
              </tr>
            </template>
            <template v-else>
              <tr v-for="favorite in favorites" :key="favorite.id" class="bg-gray-600 rounded-lg shadow-md p-4 text-center border-collapse border border-slate-500">
                <td>{{favorite.name}}</td>
                <td>{{favorite.family}}</td>
                <td>{{favorite.fruitOrder}}</td>
                <td>{{favorite.genus}}</td>
                <td>{{favorite.nutrition.calories}}</td>
                <td>{{favorite.nutrition.fat}}</td>
                <td>{{favorite.nutrition.sugar}}</td>
                <td>{{favorite.nutrition.carbohydrates}}</td>
                <td>{{favorite.nutrition.protein}}</td>
                <td class="w-4 p-4">
                  <div class="flex items-center">
                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold rounded" @click="toggleFavorite(favorite)">
                      Remove
                    </button>
                  </div>
                </td>
              </tr>
              <tr class="bg-gray-600 rounded-lg shadow-md p-4 text-center border-collapse border border-slate-500 h-12">
                <td colspan="4">Total</td>
                <td>{{fixFloatingPoint(totalSum.calories)}}</td>
                <td>{{fixFloatingPoint(totalSum.fat)}}</td>
                <td>{{fixFloatingPoint(totalSum.sugar)}}</td>
                <td>{{fixFloatingPoint(totalSum.carbohydrates)}}</td>
                <td>{{fixFloatingPoint(totalSum.protein)}}</td>
                <td></td>
              </tr>
            </template>
          </tbody>
        </table>
        <div class="flex justify-center mt-6">
          <button claclassNamess="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" :disabled="currentPage === 1" @click="prevPage">Prev</button>
          <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" :disabled="currentPage === totalPages" @click="nextPage">Next</button>
        </div>
      </div>
  </template>
  
<script lang="ts" setup>
import { ref, reactive, computed } from 'vue';
import { Fruit } from '../config/types';
import { toast } from 'vue3-toastify';
const AllFruit_Title = "All Fruits"
const FavorFruit_Title = "Favorite Fruits"

const pageTitle = ref(AllFruit_Title)

const filter = reactive({
  name: '',
  family: '',
});

const totalSum = reactive({
  calories: 0,
  fat: 0,
  sugar: 0,
  carbohydrates: 0,
  protein: 0,
})

const currentPage = ref(1);
const pageSize = 9;
const fruits = ref([] as Fruit[]);
const favorites = ref([] as Fruit[]);

// fetch fruits data and populate the fruits array
async function fetchFruits() {
  const response = await fetch('http://localhost:8000/fruits');
  const jsonData = await response.json();
  console.log(jsonData)
  fruits.value = jsonData
}

// filter fruits by name and/or family
const filteredFruits = computed(() => {
  return fruits.value.filter(fruit => {
    const nameMatch = fruit.name.toLowerCase().includes(filter.name.toLowerCase());
    const familyMatch = fruit.family.toLowerCase().includes(filter.family.toLowerCase());
    filterFruits();
    return nameMatch && familyMatch;
  });
});

// paginate the filtered fruits
const paginatedFruits = computed(() => {
  const startIndex = (currentPage.value - 1) * pageSize;
  const endIndex = startIndex + pageSize;
  return filteredFruits.value.slice(startIndex, endIndex);
});

// calculate the total number of pages
const totalPages = computed(() => {
  return Math.ceil(filteredFruits.value.length / pageSize);
});

// filter fruits when the form is submitted
function filterFruits() {
  currentPage.value = 1;
}

// go to the previous page
function prevPage() {
  currentPage.value--;
}

// go to the next page
function nextPage() {
  currentPage.value++;
}

// add or remove a fruit from the favorites array
function toggleFavorite(fruit: Fruit) {
  const index = favorites.value.findIndex(f => f.id === fruit.id);
  if (index !== -1) {
    favorites.value.splice(index, 1);
  } else if (favorites.value.length < 10) {
    favorites.value.push(fruit);
  } else if (favorites.value.length == 10) {
    toast.error('You can only have up to 10 favorites!');
    return;
  }

  calcTotalSum(fruit, index);
}

const fixFloatingPoint = (val: any) => Number.parseFloat(val.toFixed(2))

function calcTotalSum(fruit: Fruit, type: number) {
  if( type === -1 ) { //add
    totalSum.calories += fruit.nutrition.calories;
    totalSum.fat += fruit.nutrition.fat;
    totalSum.sugar += fruit.nutrition.sugar;
    totalSum.carbohydrates += fruit.nutrition.carbohydrates;
    totalSum.protein += fruit.nutrition.protein;
  } else {  // remove
    totalSum.calories -= fruit.nutrition.calories;
    totalSum.fat -= fruit.nutrition.fat;
    totalSum.sugar -= fruit.nutrition.sugar;
    totalSum.carbohydrates -= fruit.nutrition.carbohydrates;
    totalSum.protein -= fruit.nutrition.protein;
  }
}

// check if a fruit is in the favorites array
function isFavorite(fruit: Fruit) {
  return favorites.value.findIndex(f => f.id === fruit.id) !== -1;
}

function toggleTab(tab: string) {
  pageTitle.value = tab;
}

// fetch fruits when the component is mounted
fetchFruits();
</script>
