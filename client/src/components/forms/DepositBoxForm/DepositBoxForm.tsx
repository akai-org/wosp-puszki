import { InputNumber, Select, Space, Typography } from 'antd';
import s from './DepositBoxForm.module.less';
const { Title, Text } = Typography;
import { DepositColumn } from '../DepositFormColumn';
export const DepositBoxForm = () => {
  return (
    <>
      <Title level={3} className={s.title}>
        Rozliczenie puszki wolontariusza Patrycja Majewski ( 123 ) ( ID puszki w bazie: 22
        )
      </Title>
      <DepositColumn>
        <InputNumber addonBefore="+" defaultValue={100} />
      </DepositColumn>
    </>
  );
};
