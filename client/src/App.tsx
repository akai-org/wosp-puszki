import { Space } from 'antd';
import { LoginForm } from './components/forms/LoginForm/LoginForm';

function App() {
  return (
    <Space
      align="center"
      style={{
        width: '100vw',
        height: '100vh',
        justifyContent: 'center',
      }}
    >
      <LoginForm />
    </Space>
  );
}

export default App;
