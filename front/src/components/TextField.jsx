/* eslint-disable react/display-name */
import React from 'react';
import { Input } from '@headlessui/react';
import { CircleAlert } from 'lucide-react';

export const TextField = React.forwardRef(({ error, ...inputProps }, ref) => {
  return (
    <div className="flex flex-col gap-3">
      <div
        className={`border border-1 border-border rounded text-sm placeholder-placeholder text-inputText inset-0 focus-within:border-2 focus-within:border-outline ${error && 'border-borderError'}`}
      >
        <Input
          ref={ref}
          type="text"
          {...inputProps}
          className="py-4 px-3 w-full outline-none rounded"
        />
      </div>
      {error && (
        <div className="flex flex-row items-center gap-2">
          <CircleAlert className="text-textError" size={16} />
          <span className="block text-textError text-[12px]">{error.message}</span>
        </div>
      )}
    </div>
  );
});