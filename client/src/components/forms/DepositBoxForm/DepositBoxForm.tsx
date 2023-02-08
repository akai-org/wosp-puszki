import { Space, Typography } from 'antd';
import s from './DepositBoxForm.module.less';
const { Title } = Typography;
import { DepositColumn } from '../DepositFormColumn';
import { InputNumberBox } from '../InputNumberBox';
import { Content } from 'antd/lib/layout/layout';
import { FormButton } from '@/components';
import TextArea from 'antd/lib/input/TextArea';
import { AmountsKeys, moneyValuesType, useDepositContext } from './DepositContext';
import { useNavigate } from 'react-router-dom';
import { useMutation } from '@tanstack/react-query';
import {
  APIManager,
  fetcher,
  useAuthContext,
  useBoxContext,
  useSetStationUnavailableQuery,
} from '@/utils';
import { CalculatorView } from '@/components/Calculator/View/CalculatorView';
import { Dispatch, SetStateAction, useEffect, useState } from 'react';
import { Spinner } from '@components/Layout/Spinner/Spinner';
import { FormMessage, GIVE_BOX_WRONG_ID_ERROR_RESPONSE, NetworkError } from '@/utils';



function handleError(
  error: unknown,
  setError: Dispatch<SetStateAction<FormMessage | undefined>>,
) {
  if (error instanceof NetworkError) {
    handleNetworkError(error);
  } else {
    handleDefaultError();
  }

  function handleDefaultError() {
    if (typeof error === 'string') {
      setError({ type: 'error', content: error });
    } else {
      setError({ type: 'error', content: 'Wystąpił nieznany błąd' });
    }
  }

  function handleNetworkError(error: NetworkError) {
    const errorData = JSON.parse(error.message);

    if (typeof errorData === 'object' && errorData['error']) {
      handlerErrorMessage();
    } else {
      setError({ type: 'error', content: 'Nie znaleziono puszki' });
    }
    function handlerErrorMessage() {
      const errorMessage = errorData.error;
      if (errorMessage === GIVE_BOX_WRONG_ID_ERROR_RESPONSE) {
        setError({ type: 'error', content: 'Podano nieprawidłowy identyfikator' });
      } else {
        setError({ type: 'error', content: errorMessage });
      }
    }
  }
}

export const DepositBoxForm = () => {
  const [message, setMessage] = useState<FormMessage | undefined>();
  const { boxData, handleAmountsChange, sum, moneyValues } = useDepositContext();
  const { boxIdentifier, collectorName, collectorIdentifier } = useBoxContext();
  const navigate = useNavigate();
  useEffect(() => {
    if (
      collectorName === null ||
      collectorIdentifier === null ||
      boxIdentifier === null
    ) {
      navigate('/liczymy/boxes/settle');
    }
  }, [boxIdentifier, collectorName, collectorIdentifier]);

  const { username } = useAuthContext();
  useSetStationUnavailableQuery(username);

  const mutation = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/boxes/${boxIdentifier}`, {
        method: 'POST',
        body: { comment: boxData.comment, ...boxData.amounts },
      }),
    onSuccess: () => navigate('/liczymy/boxes/settle/4'),
    onError: (error) => {
      handleError(error, setMessage);
    },
  });

  const acc = sum(boxData.amounts);

  const handleSubmit = () => {
    mutation.mutate();
  };

  const amounts = Object.keys(boxData['amounts']);
  const values = Object.keys(moneyValues);

  const inputs = amounts.map((key, index) => {
    const value: string = values[index];

    return (
      <InputNumberBox
        count={handleAmountsChange}
        name={value}
        value={Number(
          (
            boxData.amounts[key as keyof Record<AmountsKeys, number>] *
            moneyValues[value as keyof moneyValuesType]
          ).toFixed(2),
        )}
        id={key}
        df={boxData.amounts[key as keyof Record<AmountsKeys, number>]}
      />
    );
  });

  return (
    <Content className={s.full}>
      <CalculatorView />
      <Title level={4} className={s.title}>
        Rozliczenie puszki wolontariusza {collectorName} ( {collectorIdentifier} ) ( ID
        puszki w bazie:
        {boxIdentifier} )
      </Title>
      <Space className={s.columns}>
        <DepositColumn>
          {inputs.slice(0, 10).map((input) => {
            return input;
          })}
        </DepositColumn>
        <DepositColumn>
          <Space className={s.sum}>
            <>Suma</>
            <>{acc.toFixed(2).toString() + ' zł'}</>
          </Space>
        </DepositColumn>
      </Space>
      <Space direction="vertical" size={10} align="center" className={s.submitContainer}>
        <FormButton type="primary" onClick={handleSubmit}>
          {mutation.isLoading ? <Spinner /> : 'Rozlicz Puszkę'}
        </FormButton>
      </Space>
      {message && (
        <div className={s.error}>
          <p>{message.content}</p>
        </div>
      )}
    </Content>
  );
};
