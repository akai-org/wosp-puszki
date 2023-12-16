import { NewVolunteerForm } from '@/components';
import { Content } from 'antd/lib/layout/layout';
import s from '../AdminPage.module.less';
export const AddVolunteerPage = () => {
  return (
    <Content className={s.small_form_container}>
      <NewVolunteerForm />
    </Content>
  );
};
