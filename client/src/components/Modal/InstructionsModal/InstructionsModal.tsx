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
    >
      <Row>
        <Col xs={24} md={14} className={s.leftColumn}>
          <div className={s.imageWrapper}>
            <div className={s.stepsContainer}>
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
              className={s.image}
            />
          </div>
        </Col>

        <Col xs={24} md={10} className={s.rightColumn}>
          <div>
            <Title level={3} className={s.stepTitle}>
              {currentContent.title}
            </Title>

            <Paragraph className={s.stepDescription}>
              {currentContent.description}
            </Paragraph>
          </div>

          <div className={s.controlsContainer}>
            <div className={s.buttonsContainer}>
              <Button
                onClick={handlePrev}
                disabled={currentStep === 0}
                icon={<LeftOutlined />}
              >
                Wstecz
              </Button>

              <Button type="primary" onClick={handleNext} className={s.primaryButton}>
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
