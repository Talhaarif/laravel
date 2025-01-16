import { createRouter, createWebHistory } from 'vue-router';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Dashboard from './components/Dashboard.vue';
import EBooksPage from './components/EBooksPage.vue';
import Home from './components/Home.vue';
import EbookDetails from './components/EbookDetails.vue';
import EBookList from './components/EBookList.vue';
import EditEbook from './components/EditEbook.vue';
import CreateEBook from './components/AddEBook.vue';
import PollView from './components/PollView.vue';
import CoursesView from './components/CoursesView.vue';
import CourseDetail from './components/CourseDetail.vue';
import FlavorMealsView from './components/FlavorMealsView.vue';
import ProfileView from './components/ProfileView.vue';
import CourseList from './components/courseList.vue';
import CourseEdit from './components/courseEdit.vue';
import AddCourse from './components/AddCourse.vue';
import MealEdit from './components/mealEdit.vue';
import addMeal from './components/addMeal.vue';
import mealList from './components/mealList.vue';
import MealDetail from './components/MealDetail.vue';
import WorkoutView from './components/WorkoutView.vue';
import WorkoutList from './components/WorkoutList.vue';
import AddWorkout from './components/AddWorkout.vue';
import WorkoutEdit from './components/WorkoutEdit.vue';
import WorkoutDetails from './components/WorkoutDetails.vue';
import ArticleView from './components/ArticleView.vue';

const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login,
    meta: { hideLayout: true }, // Hide Sidebar and Header
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
    meta: { hideLayout: true }, // Hide Sidebar and Header
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard, // Parent layout component
    children: [
      {
        path: '', // Default route
        name: 'Home',
        component: Home,
      },
      {
        path: 'ebooks',
        name: 'EBooks',
        component: EBooksPage,
      },
      {
        path: 'ebook-details/:slug',
        name: 'EbookDetails',
        component: EbookDetails,
        props: true, // Enable passing route params as props
      },
      {
        path: 'ebook-list',
        name: 'EBookList',
        component: EBookList,
      },
      {
        path: 'create-ebook',
        name: 'CreateEBook',
        component: CreateEBook,
      },
      {
        path: 'ebook-edit/:id',
        name: 'EditEbook',
        component: EditEbook,
        props: true, // Enable passing route params as props
      },
      {
        path: 'courses',
        name: 'courses',
        component: CoursesView,
      },
      {
        path: 'courses/:id',
        name: 'DetailCourse',
        component: CourseDetail,
        props: true,
      },
      {
        path: 'courses-list',
        name: 'CourseList',
        component: CourseList,
      },
      {
        path: 'create-course',
        name: 'AddCourse',
        component: AddCourse,
      },
      {
        path: 'course-edit/:id',
        name: 'EditCourse',
        component: CourseEdit,
        props: true, // Enable passing route params as props
      },
      {
        path: 'polls',
        name: 'PollView',
        component: PollView,
      },
      {
        path: 'flavor-meals',
        name: 'FlavorMeals',
        component: FlavorMealsView,
      },
      {
        path: 'meal-list',
        name: 'mealList',
        component: mealList,
      },
      {
        path: 'create-meal',
        name: 'AddMeal',
        component: addMeal,
      },
      {
        path: 'meal-edit/:id',
        name: 'EditMeal',
        component: MealEdit,
        props: true, // Enable passing route params as props
      },
      {
        path: 'Meal-deatil/:slug',
        name: 'MealDetail',
        component: MealDetail,
        props: true,
      },
      {
        path: 'Profile',
        name: 'profile',
        component: ProfileView,
      },
      {
        path: 'workouts',
        name: 'workouts',
        component: WorkoutView,
      },
      {
        path: 'workouts-list',
        name: 'WorkoutList',
        component: WorkoutList,
      },
      {
        path: 'add-workouts',
        name: 'AddWorkout',
        component: AddWorkout,
      },
      {
        path: 'workouts-edit/:id',
        name: 'WorkoutEdit',
        component: WorkoutEdit,
        props: true, // Enable passing route params as props
      },
      {
        path: 'workouts-deatil/:slug',
        name: 'WorkoutDetails',
        component: WorkoutDetails,
        props: true,
      },
      {
        path: 'articles',
        name: 'Articles',
        component: ArticleView,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
