import Sidebar from './components/Layout/Sidebar';
import { LoginPage } from './pages';
import s from './App.module.less';

function App() {
  const isLoggedIn = false;

  return (
    <section className={isLoggedIn ? s.bigContainer : s.smallContainer}>
      <Sidebar isLoggedIn={isLoggedIn} />
      <LoginPage />
    </section>
  );
}
export default App;
