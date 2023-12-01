import { Space, Typography } from 'antd';
import { FC } from 'react';
import s from './Line.module.less';
const { Text } = Typography;

interface Props {
    denomination: string;
    amount: number;
    value: number;
    data_testid: string;
}

export const ContentLine_Three: FC<Props> = ({
    denomination,
    amount,
    value,
    data_testid,
}) => {
    return (
        <Space size={60} data-testid={'columnLine'} className={s.columnLine}>
            <Text data-testid={['denomination', data_testid]} className={s.denomination}>
                {denomination}
            </Text>
            <Text data-testid={['amount', data_testid]} className={s.amount}>
                {amount}
            </Text>
            <Text data-testid={['value', data_testid]} className={s.value}>
                {`${value.toFixed(2)} zł`}
            </Text>
        </Space>
    );
};
