import { InputNumber, Select, Space, Typography } from 'antd';
import s from './DepositBoxForm.module.less';
const { Title, Text } = Typography;
import { DepositColumn } from '../DepositFormColumn';
import { InputNumberBox } from '../InputNumberBox';
import { Content } from 'antd/lib/layout/layout';

export const DepositBoxForm = () => {
  return (
    <Content className={s.full}>
      <Title level={3} className={s.title}>
        Rozliczenie puszki wolontariusza Patrycja Majewski ( 123 ) ( ID puszki w bazie: 22
        )
      </Title>
      <Space className={s.columns}>
        <DepositColumn>
          <InputNumberBox denomination="1gr" value={0} />
          <InputNumberBox denomination="2gr" value={0} />
          <InputNumberBox denomination="5gr" value={0} />
          <InputNumberBox denomination="10gr" value={0} />
          <InputNumberBox denomination="20gr" value={0} />
          <InputNumberBox denomination="50gr" value={0} />
          <InputNumberBox denomination="1zł" value={0} />
          <InputNumberBox denomination="2zł" value={0} />
          <InputNumberBox denomination="5zł" value={0} />
        </DepositColumn>
        <DepositColumn>
          <InputNumberBox denomination="10zł" value={0} />
          <InputNumberBox denomination="20zł" value={0} />
          <InputNumberBox denomination="50zł" value={0} />
          <InputNumberBox denomination="100zł" value={0} />
          <InputNumberBox denomination="200zł" value={0} />
          <InputNumberBox denomination="500zl" value={0} />
          <>Suma</>
        </DepositColumn>
        <DepositColumn>
          <Space className={s.foreignContainer}>
            <Text>Euro ( EUR )</Text>
            <InputNumber
              addonBefore="+"
              defaultValue={0}
              type="number"
              className={s.inputNumber}
            />
            <Text>0 zł</Text>
          </Space>
          <Space className={s.foreignContainer}>
            <Text className={s.foreignText}>
              Funt brytyjski <br />( GBP )
            </Text>
            <InputNumber
              addonBefore="+"
              defaultValue={0}
              type="number"
              className={s.inputNumber}
            />
            <Text>0 zł</Text>
          </Space>
          <Space className={s.foreignContainer}>
            <Text>
              Dolar amerykański <br />( USD )
            </Text>
            <InputNumber
              addonBefore="+"
              defaultValue={0}
              type="number"
              className={s.inputNumber}
            />
            <Text>0 zł</Text>
          </Space>
          <Space>
            <Text>Inne</Text>
            <>TExtArea</>
          </Space>
        </DepositColumn>
      </Space>
    </Content>
  );
};
