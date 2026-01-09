import React, { useState, useEffect } from 'react';
import { Modal, Button, Typography, Steps, Checkbox, Image, Row, Col } from 'antd';
import { LeftOutlined, RightOutlined } from '@ant-design/icons';
import s from './InstructionsModal.module.less';

const { Title, Paragraph, Text } = Typography;

const INSTRUCTION_STEPS = [
  {
    title: 'Rozpoczęcie rozliczania',
    description:
      'Aby rozpocząć, kliknij przycisk "Jestem gotowy rozliczyć następną puszkę".',
    imageSrc: '/instructions/instruction-01-start.png',
  },
  {
    title: 'Identyfikacja puszki',
    description:
      'Wpisz numer identyfikatora z puszki wolontariusza. Upewnij się, że numer jest poprawny, a następnie kliknij czerwony przycisk "Wyszukaj puszkę".',
    imageSrc: '/instructions/instruction-02-find.png',
  },
  {
    title: 'Weryfikacja danych',
    description:
      'Sprawdź, czy dane wolontariusza zgadzają się z identyfikatorem. Jeśli puszka nie jest uszkodzona, kliknij "Potwierdzam Zgodność z danymi rzeczywistymi".',
    imageSrc: '/instructions/instruction-03-verify.png',
  },
  {
    title: 'Liczenie pieniędzy',
    description:
      'Wpisz ilość poszczególnych nominałów w formularzu. Waluty obce wpisz w kolumnie po prawej stronie. Gdy skończysz, kliknij przycisk "Rozlicz Puszkę".',
    imageSrc: '/instructions/instruction-04-counting.png',
  },
  {
    title: 'Zatwierdzenie',
    description:
      'Sprawdź, czy suma końcowa zgadza się z przeliczoną gotówką. Jeśli wszystko jest poprawne, kliknij zielony przycisk "Potwierdź rozliczenie puszki".',
    imageSrc: '/instructions/instruction-05-summary.png',
  },
];

interface InstructionsModalProps {
  isOpen: boolean;
  onClose: () => void;
}

export const InstructionsModal = ({ isOpen, onClose }: InstructionsModalProps) => {
  const [currentStep, setCurrentStep] = useState(0);

  const [dontShowOnLogin, setDontShowOnLogin] = useState<boolean>(() => {
    try {
      const hide = !!localStorage.getItem('HIDE_INSTRUCTIONS_ON_LOGIN');
      if (hide) {
        return true;
      }
    } catch {}
    return false;
  });

  useEffect(() => {
    if (isOpen) setCurrentStep(0);
  }, [isOpen]);

  const handleNext = () => {
    if (currentStep < INSTRUCTION_STEPS.length - 1) {
      setCurrentStep(currentStep + 1);
    } else {
      handleClose();
    }
  };

  const handlePrev = () => {
    if (currentStep > 0) {
      setCurrentStep(currentStep - 1);
    }
  };

  const handleClose = () => {
    onClose();
  };

  const currentContent = INSTRUCTION_STEPS[currentStep];

  return (
    <Modal
      open={isOpen}
      onCancel={onClose}
      width={900}
      centered
      footer={null}
      maskClosable={false}
      className={s.instructionsModal}
      bodyStyle={{ padding: 0 }}
    >
      <Row>
        <Col
          xs={24}
          md={14}
          style={{
            background: '#f0f2f5',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            minHeight: '450px',
            borderRight: '1px solid #f0f0f0',
            padding: '20px',
          }}
        >
          <div style={{ width: '100%', textAlign: 'center' }}>
            <div
              style={{
                width: '150px',
                minWidth: '150px',
                flex: '0 0 auto',
                marginBottom: '32px',
                marginLeft: '-12px',
                marginRight: 'auto',
                alignSelf: 'flex-start',
                transform: 'scale(0.7)',
                transformOrigin: 'left center',
              }}
            >
              <Steps size="small" current={currentStep} progressDot>
                {INSTRUCTION_STEPS.map((step, index) => (
                  <Steps.Step key={index} />
                ))}
              </Steps>
            </div>

            <Image
              src={currentContent.imageSrc}
              alt={currentContent.title}
              preview={false}
              fallback="https://placehold.co/600x400?text=Brak+Zdjecia"
              style={{
                maxWidth: '100%',
                maxHeight: '350px',
                objectFit: 'contain',
                borderRadius: '8px',
                boxShadow: '0 4px 12px rgba(0,0,0,0.1)',
              }}
            />
          </div>
        </Col>

        <Col
          xs={24}
          md={10}
          style={{
            padding: '32px',
            display: 'flex',
            flexDirection: 'column',
            justifyContent: 'space-between',
          }}
        >
          <div>
            <Title level={3} style={{ marginBottom: '16px', color: '#d32f2f' }}>
              {currentContent.title}
            </Title>

            <Paragraph style={{ fontSize: '16px', color: '#595959', lineHeight: '1.6' }}>
              {currentContent.description}
            </Paragraph>
          </div>

          <div style={{ marginTop: '32px' }}>
            <div
              style={{
                display: 'flex',
                justifyContent: 'space-between',
                marginBottom: '16px',
              }}
            >
              <Button
                onClick={handlePrev}
                disabled={currentStep === 0}
                icon={<LeftOutlined />}
              >
                Wstecz
              </Button>

              <Button
                type="primary"
                onClick={handleNext}
                style={{ background: '#d32f2f', borderColor: '#d32f2f' }}
              >
                {currentStep === INSTRUCTION_STEPS.length - 1 ? 'Zakończ' : 'Dalej'}
                {currentStep !== INSTRUCTION_STEPS.length - 1 && <RightOutlined />}
              </Button>
            </div>
            <Checkbox
              checked={dontShowOnLogin}
              onChange={(e) => {
                setDontShowOnLogin(e.target.checked);
                if (e.target.checked) {
                  localStorage.setItem('HIDE_INSTRUCTIONS_ON_LOGIN', '1');
                } else {
                  localStorage.removeItem('HIDE_INSTRUCTIONS_ON_LOGIN');
                }
              }}
            >
              Nie pokazuj ponownie
            </Checkbox>
          </div>
        </Col>
      </Row>
    </Modal>
  );
};
