import { NewUserForm } from '@/components';
import s from '../AdminPage.module.less';
import { Content } from 'antd/lib/layout/layout';
export const AddUserPage = () => {
  return (
    <Content className={s.small_form_container}>
      <NewUserForm />
    </Content>
  );
};
