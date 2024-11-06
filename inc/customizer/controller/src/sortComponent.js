const { useState, useEffect } = wp.element;
const { escapeHTML } = wp.escapeHtml;
const { customize } = wp;
const { Dashicon } = wp.components
import { BlogmaticControlHeader } from './component-function';
import { DndContext, closestCenter } from '@dnd-kit/core';
import { SortableContext, useSortable, arrayMove, verticalListSortingStrategy } from '@dnd-kit/sortable';
import { CSS } from '@dnd-kit/utilities';

export const BlogmaticItemSort = ( props ) => {
    const [ items, setItems ] = useState( props.value );
    const { label, description, fields } = customize.control( props.setting ).params

    useEffect(() => {
        customize.value( props.setting )( items )
    }, [ items ]);

    return (
        <>
            <BlogmaticControlHeader label={ label } description={ description } />
            <DndContext
                collisionDetection = { closestCenter }
                onDragEnd = { handleDragEnd }
            >
                <div className='items-wrap'>
                    <SortableContext 
                        items = { items }
                        strategy = { verticalListSortingStrategy }
                    >
                        <div className='sort-list'>
                            { items.map(( item, index ) => { return <SortableItem index={ index } key={ index } item={ item } fields={ fields }/> }) }
                        </div>
                    </SortableContext>
                </div>
            </DndContext>
        </>
    );
    
    /**
     * Event that fires on drag on
     * 
     * @since 1.0.0
     */
    function handleDragEnd( event ) {
        const { active, over } = event;
        const OLDINDEX = items.findIndex(( item ) => item === active.id )
        const NEWINDEX = items.findIndex(( item ) => item === over.id )
        if ( active.id !== over.id ) {
            setItems( arrayMove( items, OLDINDEX, NEWINDEX ) )
        }
    }
}

export function SortableItem({ item, fields, index }) {
    const { value, option } = item

    const {
        attributes,
        listeners,
        setNodeRef,
        transform,
        transition
    } = useSortable({ id: item });
    
    const style = {
        transform: CSS.Transform.toString( transform ),
        transition
    };

    let elementClass = 'sort-item' + ' ' + value + ( option ? ' visible' : ' invisible' )
    
    return (
      <div ref={ setNodeRef } style={ style } { ...attributes } { ...listeners } className={ elementClass }>
            <span className="sort-title">{ escapeHTML( fields[value].label ) }</span>
            <Dashicon className="movable-field-icon" icon="menu-alt3" />
            { ( 'focusable_control' in fields[value] ) && <Dashicon className="redirect-icon" icon="arrow-right-alt2" onClick={() => customize.control( fields[value].focusable_control ).focus() }/> }
      </div>
    );
  }